<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\ArtikelDeleteEvent;
use App\Models\Article;
use App\Services\SummernoteService;
use App\Services\UploadService;
use App\Models\Artikel;
use App\Models\CategoryArticle;
use App\Models\KategoriArtikel;
use Str;
use File;

class ArtikelController extends Controller
{
    // private $summernoteService;
    // private $uploadService;

    // public function __construct(SummernoteService $summernoteService, UploadService $uploadService)
    // {
    //     $this->summernoteService = $summernoteService;
    //     $this->uploadService = $uploadService;
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $article = Article::with(['user','categoryArticle'])->get();
        return view('admin.artikel.index',[
            'article'   =>$article
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoryArticle = CategoryArticle::all();
        return view('admin.artikel.create',[
            'categoryArticle'   =>  $categoryArticle
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image=Article::saveImage($request);
        Article::create([
            'title' => $request->title,
            'deskripsi' => $request->deskripsi,
            'thumbnail' => $image,
            'slug' => Str::slug($request->title),
            'user_id' => auth()->user()->id,
            'category_article_id' => $request->category_article_id,
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
        $article =Article::find($id);
        $categoryArticle = CategoryArticle::oldest('name')
        ->get();
        return view('admin.artikel.edit',[
            'article'   => $article,
            'categoryArticle'   =>$categoryArticle
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
            'title'=>$request->title,
            'deskripsi'=>$request->deskripsi,
        ];

        $image=Article::saveImage($request);
        if ($image) {
            $data['thumbnail']=$image;
            Article::deleteImage($id);
        }

        Article::where('id', $id)->update($data);
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
        $article=Article::find($id);

        Article::deleteImage($id);

        $article->delete();
        return redirect()->route('admin.artikel.index')->with('success','Data berhasil dihapus');
    }
}
