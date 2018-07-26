<?php
/*
 * @Author: Ferdhika Yudira 
 * @Website: http://dika.web.id 
 * @Date:   2018-07-26 16:30:45 
 * @Email: fer@dika.web.id 
 */
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Models\Logbook;
use App\Models\Project;
use App\Models\Perusahaan;
use App\Models\Periode;

class LogbookController extends Controller{

    public $routePath = "backend::logbook";
    public $prefix = "backend.logbook";

    /**
     * Show the application dashboard.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $data['page_name'] = "Logbook";
        $data['page_description'] = "Menejemen logbook";

        $user = User::findOrFail(Auth::user()->id);
        
        $model = Logbook::join('periode', 'logbook.periode_id', '=', 'periode.id')->
        with(['periode' => function($query) use ($user) {
            $query->where('user_id', $user->id);
        }])->orderBy('no', 'asc')->orderBy('subno', 'asc')->paginate(10);

        $data['data'] = $model;

        return view($this->prefix.'.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $data['page_name'] = "Buat Logbook";
        $data['page_description'] = "Buat logbook baru";

        $user = User::findOrFail(Auth::user()->id);

        $data['periode'] = Periode::where('user_id', Auth::user()->id)->orderBy('no', 'asc')->get();
        $data['project'] = Project::whereHas('perusahaan', function($query) use ($user) {
            $query->where('perusahaan_id', $user->perusahaan_id);
        })->orderBy('created_at', 'asc')->get();

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
            'periode'   => 'required',
            'tgl'       => 'required',
            'project'   => 'required',
            'tugas'     => 'required',
            'kegiatan'  => 'required',
            'tools'     => 'required',
            'hasil'     => 'required',
            'keterangan'=> 'required'
        ]);

        $user = User::findOrFail(Auth::user()->id);

        $periode = Periode::where('user_id', Auth::user()->id)->findOrFail($request->periode);
        $project = Project::whereHas('perusahaan', function($query) use ($user) {
            $query->where('perusahaan_id', $user->perusahaan_id);
        })->findOrFail($request->project);

        $last = Logbook::where('periode_id', $request->periode)->orderBy('subno', 'desc')->first();
        $subNo = (!empty($last)) ? $last->subno+1 : 1;

        $logbook = new Logbook;
        $logbook->subno = $subNo;
        $logbook->tanggal = $request->tgl;
        $logbook->tugas = $request->tugas;
        $logbook->kegiatan_harian = $request->kegiatan;
        $logbook->tools = $request->tools;
        $logbook->hasil_kerja = $request->hasil;
        $logbook->keterangan = $request->keterangan;
        $logbook->periode()->associate($periode);
        $logbook->project()->associate($project);

        $logbook->save();

        return redirect()->route($this->routePath. ".index")->with('success', "Data berhasil di simpan.");
    }
}