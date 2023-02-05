<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalKegiatan;
use Carbon\Carbon;
use Str;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jadwalKegiatan = JadwalKegiatan::all();
        return view('admin.agenda.index', [
            'jadwalKegiatan'    => $jadwalKegiatan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.agenda.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->request->add([
        //     'tgl' => date('Y-m-d'),
        //     'slug' => Str::slug($request->judul),
        //     'user_id' => auth()->user()->id,
        // ]);
        // Agenda::create($request->all());
        

        JadwalKegiatan::create([
            'tanggal_awal'  => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir,
            'uraian' => $request->uraian,
            'keterangan' => $request->keterangan,
        ]);



        return redirect()->route('admin.agenda.index')->with('success', 'Data berhasil ditambah');
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
        $jadwalKegiatan=JadwalKegiatan::find($id);
        return view('admin.agenda.edit', [
            'jadwalKegiatan'    =>  $jadwalKegiatan
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

        return redirect()->route('admin.agenda.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jadwalKegiatan=JadwalKegiatan::find($id);
        
        $jadwalKegiatan->delete();
        return redirect()->route('admin.agenda.index')->with('success', 'Data berhasil dihapus');
    }

    // /**
    //  * Segera Publish.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function segeraPublish($id)
    // {
    //     $jadwalKegiatan=JadwalKegiatan::find($id);
    //     if ($jadwalKegiatan->status == 'Pending') {
    //         $jadwalKegiatan->status ='Segera Dipublish';
    //     }else{
    //         $jadwalKegiatan->status = 'Pending';
    //     }
    //     $jadwalKegiatan->save();

    //     return redirect()->route('admin.agenda.index')->with('success', 'Data berhasil Diubah');
    // }

    // /**
    //  * Publish.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function getStatus($id)
    // {
    //     // $jadwalKegiatan=JadwalKegiatan::where('status', 'Publish')->get();
    //     $jadwalKegiatan=JadwalKegiatan::where('status')
    //     ->get();
    //     // foreach ($jadwalKegiatan->status === 'Pending') {
    //     //     if($jadwalKegiatan->tanggal_awal <= 7){
    //     //         $jadwalKegiatan->status = 'Publish';
    //     //     }
    //     // }else{
    //     //     $jadwalKegiatan->status = 'Pending';
    //     // }

    //     foreach ($jadwalKegiatan as $key => $value) {
    //         $value=JadwalKegiatan::where('tanggal_awal', '<=', 7)->first();
    //         if($value){
    //             JadwalKegiatan::where('id', $id)->update([
    //                 'status'=> 'Publish'
    //             ]);

    //             $value->save();
    //         }
    //     }

    // }
    



    





    
    
}
