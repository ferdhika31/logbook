<?php
/*
 * @Author: Ferdhika Yudira 
 * @Website: http://dika.web.id 
 * @Date:   2018-07-26 15:44:50 
 * @Email: fer@dika.web.id 
 */
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Models\Project;
use App\Models\Perusahaan;

class ProjectController extends Controller{

    public $routePath = "backend::project";
    public $prefix = "backend.project";

    /**
     * Show the application dashboard.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $data['page_name'] = "Project";
        $data['page_description'] = "Menejemen project";

        $user = User::findOrFail(Auth::user()->id);
        
        $model = Project::whereHas('perusahaan', function($query) use ($user) {
            $query->where('perusahaan_id', $user->perusahaan_id);
        })->orderBy('created_at', 'asc')->paginate(10);

        $data['data'] = $model;

        return view($this->prefix.'.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $data['page_name'] = "Buat Project";
        $data['page_description'] = "Buat project baru";

        return view($this->prefix.'.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        // validasi form
        $this->validate($request, [
            'nama'          => 'required|string',
            'project_manager' => 'required|string',
            'technical_leader' => 'required|string'
        ]);

        $user = User::findOrFail(Auth::user()->id);
        $perusahaan = Perusahaan::findOrFail($user->perusahaan_id);

        $project = new Project;
        $project->nama_project = $request->nama;
        $project->project_manager = $request->project_manager;
        $project->technical_leader = $request->technical_leader;
        $project->perusahaan()->associate($perusahaan);

        $project->save();

        return redirect()->route($this->routePath. ".index")->with('success', "Data berhasil di simpan.");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $user = User::findOrFail(Auth::user()->id);

        $data = Project::whereHas('perusahaan', function($query) use ($user) {
            $query->where('perusahaan_id', $user->perusahaan_id);
        })->findOrFail($id);

        $parse['page_name'] = "Ubah Project";
        $parse['page_description'] = "Ubah project";
        $parse['data'] = $data;

        return view($this->prefix.'.edit', $parse);
    }

    /**
     * Update the specified resource.
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request){
        // validasi form
        $this->validate($request, [
            'nama'          => 'required|string',
            'project_manager' => 'required|string',
            'technical_leader' => 'required|string'
        ]);

        // cari data
        $user = User::findOrFail(Auth::user()->id);
        $project = Project::whereHas('perusahaan', function($query) use ($user) {
            $query->where('perusahaan_id', $user->perusahaan_id);
        })->findOrFail($id);
        // set data
        $project->nama_project = $request->nama;
        $project->project_manager = $request->project_manager;
        $project->technical_leader = $request->technical_leader;

        $project->save();

        return redirect()->route($this->routePath. ".index")->with('success', "Data berhasil di ubah.");
    }

    /**
     * Delete the specified resource.
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request){
        $data = Periode::withTrashed()->findOrFail($id);
        if(!empty($data->deleted_at)){
            $data->forceDelete();
        }else{
            $data->delete();
        }        

        return redirect()->route($this->routePath. ".index")->with('success', "Data berhasil di hapus.");
    }
}