<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalKegiatan;
use Illuminate\Http\Request;

use App\Models\Pengumuman;
use Str;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $pengumuman = Pengumuman::with(['user'])->get();
        $pengumuman=Pengumuman::all();
        return view('admin.pengumuman.index',[
            'pengumuman'=>$pengumuman
        ]);
    }


    // /**
    //  * Index Pengumuman.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function indexPengumuman(Request $request)
    // {
    //     $jadwalKegiatan=JadwalKegiatan::where('tanggal_publish')->get();

    //     return view('admin.pengumuman.index',[
    //         'jadwalKegiatan'    =>  $jadwalKegiatan
    //     ]);
    // }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pengumuman.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Pengumuman::create([
            'tanggal_awal'  => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir,
            'uraian' => $request->uraian,
            'keterangan' => $request->keterangan,
        ]);


        return redirect()->route('admin.pengumuman.index')->with('success','Data berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pengumuman=Pengumuman::find($id);
        return view('admin.pengumuman.edit',[
            'pengumuman' =>$pengumuman
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data=[
            'tanggal_awal'  => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir,
            'uraian'        => $request->uraian,
            'keterangan' => $request->keterangan,
        ];
        JadwalKegiatan::where('id', $id)->update($data);
           
        return redirect()->route('admin.pengumuman.index')->with('success','Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengumuman=Pengumuman::find($id);
        $pengumuman->delete();
        return redirect()->route('admin.pengumuman.index')->with('success','Data berhasil dihapus');
    }
}
