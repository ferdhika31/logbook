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
use PDF;
use Cloudder;

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
        
        if(!empty($request->periode)){
            $model = Logbook::where('periode_id', $request->periode)->
            whereHas('periode', function($query) use ($user) {
                $query->where('user_id', $user->id)->orderBy('no', 'asc');
            })->orderBy('subno', 'asc')->paginate(10);
        }else{
            $model = Logbook::
            whereHas('periode', function($query) use ($user) {
                $query->where('user_id', $user->id)->orderBy('no', 'asc');
            })->orderBy('subno', 'asc')->paginate(10);
        }

        $data['periode'] = Periode::where('user_id', Auth::user()->id)->orderBy('no', 'asc')->get();

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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $user = User::findOrFail(Auth::user()->id);

        $data = Logbook::with(['periode' => function($query) use ($user) {
            $query->where('user_id', $user->id);
        }])->findOrFail($id);

        $parse['periode'] = Periode::where('user_id', Auth::user()->id)->orderBy('no', 'asc')->get();
        $parse['project'] = Project::whereHas('perusahaan', function($query) use ($user) {
            $query->where('perusahaan_id', $user->perusahaan_id);
        })->orderBy('created_at', 'asc')->get();

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
            'periode'   => 'required',
            'tgl'       => 'required',
            'project'   => 'required',
            'tugas'     => 'required',
            'kegiatan'  => 'required',
            'tools'     => 'required',
            'hasil'     => 'required',
            'keterangan'=> 'required',
            'subno'     => 'required|integer'
        ]);

        // cari data
        $user = User::findOrFail(Auth::user()->id);

        $periode = Periode::where('user_id', Auth::user()->id)->findOrFail($request->periode);
        $project = Project::whereHas('perusahaan', function($query) use ($user) {
            $query->where('perusahaan_id', $user->perusahaan_id);
        })->findOrFail($request->project);

        $logbook = Logbook::
        with(['periode' => function($query) use ($user) {
            $query->where('user_id', $user->id);
        }])->findOrFail($id);
        
        $logbook->subno = $request->subno;
        $logbook->tanggal = $request->tgl;
        $logbook->tugas = $request->tugas;
        $logbook->kegiatan_harian = $request->kegiatan;
        $logbook->tools = $request->tools;
        $logbook->hasil_kerja = $request->hasil;
        $logbook->keterangan = $request->keterangan;
        $logbook->periode()->associate($periode);
        $logbook->project()->associate($project);

        $logbook->save();

        return redirect()->route($this->routePath. ".index")->with('success', "Data berhasil di ubah.");
    }

    /**
     * Export a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function export(Request $request){
        $user = User::findOrFail(Auth::user()->id);

        $periode = Periode::findOrFail($request->periode);
    
        $model = Logbook::where('periode_id', $request->periode)->
        with(['periode' => function($query) use ($user) {
            $query->where('user_id', $user->id)->orderBy('no', 'asc');
        }])->orderBy('subno', 'asc')->get();

        $fileName = $periode->no.".LogbookPeriode".str_replace('-','', $periode->tanggal_awal_periode).'-'.str_replace('-','', $periode->tanggal_akhir_periode);

        $data['periode'] = $periode;
        $data['logbook'] = $model;

        $pdf = PDF::loadView($this->prefix. ".template", $data);

        return $pdf->download($fileName.'.pdf');
    }

    /**
     * Export a newly created resource in storage.
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function exportOne($id, Request $request){
        $user = User::findOrFail(Auth::user()->id);

        $model = Logbook::with(['periode' => function($query) use ($user) {
            $query->where('user_id', $user->id);
        }])->findOrFail($id);

        $tgl = explode('-', $model->tanggal);

        $fileName = $model->periode->no.".".$model->subno.".Logbook".config('larakuy.hari')[\Carbon\Carbon::createFromFormat('Y-m-d', $model->tanggal, 'Asia/Jakarta')->dayOfWeek]."_".$tgl[2].' '.ucwords(config('larakuy.bulan')[$tgl[1]]).' '.$tgl[0];

        $data['periode'] = $model->periode;
        $data['logbook'] = $model;

        $pdf = PDF::loadView($this->prefix. ".templateOne", $data);

        return $pdf->download($fileName.'.pdf');
    }

    /**
     * Delete the specified resource.
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request){
        $data = Logbook::withTrashed()->findOrFail($id);
        if(!empty($data->deleted_at)){
            $data->forceDelete();
        }else{
            $data->delete();
        }        

        return redirect()->route($this->routePath. ".index")->with('success', "Data berhasil di hapus.");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request){
        // upload image
        $image = $request->file('file');
        if(!empty($image)){
            $d = Cloudder::upload($image->getPathName(), null, array(
                "folder" => "Logbook",
                "use_filename" => TRUE, 
                "unique_filename" => FALSE
            ));
    
            $json = [
                'status' => true,
                'data'  => $d->getResult()['url']
            ];
        }else{
            $json = [
                'status' => false,
                'data'  => null
            ];
        }

        return json_encode($json);
    }

}