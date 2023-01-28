<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\ArtikelDeleteEvent;
use App\Services\SummernoteService;
use App\Services\UploadService;
use App\Models\Artikel;
use App\Models\KategoriArtikel;
use Str;
use File;

class ArtikelController extends Controller
{
    private $summernoteService;
    private $uploadService;

    public function __construct(SummernoteService $summernoteService, UploadService $uploadService)
    {
        $this->summernoteService = $summernoteService;
        $this->uploadService = $uploadService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artikel = Artikel::with(['user','kategoriArtikel'])->get();
        return view('admin.artikel.index',compact('artikel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategoriArtikel = KategoriArtikel::all();
        return view('admin.artikel.create',compact('kategoriArtikel'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image=Artikel::saveImage($request);
        Artikel::create([
            'judul' => $request->judul,
            'deskripsi' => $this->summernoteService->imageUpload('artikel'),
            'thumbnail' => $image,
            'slug' => Str::slug($request->judul),
            'user_id' => auth()->user()->id,
            'kategori_artikel_id' => $request->kategori_artikel_id,
        ]);

        return redirect()->route('admin.artikel.index')->with('success','Data berhasil ditambah');
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
        $artikel =Artikel::find($id);
        $kategoriArtikel = KategoriArtikel::oldest('nama_kategori')
        ->get();
        return view('admin.artikel.edit',compact('artikel','kategoriArtikel'));
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
        // $this->authorize('update',$artikel);

        // Artikel::update([
        //     'judul' => $request->judul,
        //     'deskripsi' => $this->summernoteService->imageUpload('artikel'),
        //     'thumbnail' => $this->uploadService->imageUpload('artikel'),
        //     'slug' => Str::slug($request->judul),
        //     'user_id' => auth()->user()->id,
        //     'kategori_artikel_id' => $request->kategori_artikel_id,
        // ]);

        $data=[
            'judul'=>$request->judul,
            'deskripsi'=>$request->deskripsi,
        ];

        $image=Artikel::saveImage($request);
        if ($image) {
            $data['thumbnail']=$image;
            Artikel::deleteImage($id);
        }

        Artikel::where('id', $id)->update($data);
        return redirect()->route('admin.artikel.index')->with('success','Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $artikel=Artikel::find($id);

        Artikel::deleteImage($id);

        $artikel->delete();
        return redirect()->route('admin.artikel.index')->with('success','Data berhasil dihapus');
    }
}
