<?php
/*
 * @Author: Ferdhika Yudira 
 * @Website: http://dika.web.id 
 * @Date:   2018-07-26 15:02:29 
 * @Email: fer@dika.web.id 
 */
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Models\Periode;

class PeriodeController extends Controller{

    public $routePath = "backend::periode";
    public $prefix = "backend.periode";

    /**
     * Show the application dashboard.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $data['page_name'] = "Periode";
        $data['page_description'] = "Menejemen periode";

        $model = Periode::where('user_id', Auth::user()->id)->orderBy('no', 'asc')->paginate(10);

        $data['data'] = $model;

        return view($this->prefix.'.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $data['page_name'] = "Buat Periode";
        $data['page_description'] = "Buat periode baru";
        
        $model = Periode::where('user_id', Auth::user()->id)->orderBy('no', 'asc')->paginate(10);

        $data['last'] = Periode::where('user_id', Auth::user()->id)->orderBy('no', 'desc')->first();

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
            'no' => 'required|integer',
            'periode' => 'required'
        ]);

        $tgl = explode("-", $request->periode);
            
        $tglAwal = str_replace('/','-', str_replace(' ', '',$tgl[0]));
        $tglAkhir = str_replace('/','-', str_replace(' ', '',$tgl[1]));
        
        $user = User::findOrFail(Auth::user()->id);

        $periode = new Periode;
        $periode->no = $request->no;
        $periode->tanggal_awal_periode = $tglAwal;
        $periode->tanggal_akhir_periode = $tglAkhir;
        $periode->user()->associate($user);

        $periode->save();

        return redirect()->route($this->routePath. ".index")->with('success', "Data berhasil di simpan.");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $data = Periode::where('user_id', Auth::user()->id)->findOrFail($id);

        $parse['page_name'] = "Ubah Periode";
        $parse['page_description'] = "Ubah periode";
        $parse['data'] = $data;

        $parse['last'] = Periode::where('user_id', Auth::user()->id)->orderBy('no', 'desc')->first();

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
            'no' => 'required|integer',
            'periode' => 'required'
        ]);

        $tgl = explode("-", $request->periode);
            
        $tglAwal = str_replace('/','-', str_replace(' ', '',$tgl[0]));
        $tglAkhir = str_replace('/','-', str_replace(' ', '',$tgl[1]));

        // cari data
        $periode = Periode::findOrFail($id);
        // set data
        $periode->no = $request->no;
        $periode->tanggal_awal_periode = $tglAwal;
        $periode->tanggal_akhir_periode = $tglAkhir;

        $periode->save();

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