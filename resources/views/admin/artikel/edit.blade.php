@extends('layouts.backend.app',[
	'title' => 'Edit Artikel',
	'contentTitle' => 'Edit Artikel'
])

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/summernote') }}/summernote-bs4.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/dropify') }}/dist/css/dropify.min.css">
@endpush

@section('content')

<div class="">    
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Box Artikel</h4>
        </div>
        <div class="card-body">
        <form method="POST" enctype="multipart/form-data" action="{{ route('admin.artikel.update',$article) }}">
            @method('put')
            @csrf
            <div class="form-group">
                <label for="judul">Judul Artikel</label>
                <input value="{{ $article->title }}" required="" type="" name="title" placeholder="" class="form-control"> 
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Thumbnail</label>
                        <input type="file" name="thumbnail" class="dropify form-control" data-height="190" 
                        data-default-file="{{ @$article->image_url }}" data-allowed-file-extensions="png jpg gif jpeg svg webp jfif" >
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Kategori</label>
                        <select required="" class="form-control" name="category_article_id">
                        <option selected="" disabled="">- PILIH KATEGORI -</option>
                        @foreach($categoryArticle as $kategori)
                            <option value="{{ $kategori->id }}"
                                {{ old('category_article_id', @$article->category_article_id) == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->name }}
                            </option>
                        @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div id="form-group">
                <label for="deskripsi">Isi Artikel</label>
                <textarea required="" name="deskripsi" id="deskripsi" class="text-dark form-control summernote">{{ $article->deskripsi }}</textarea>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">UPDATE</button>
        </div>
        </form>
    </div>
</div>

@stop

@push('js')
<script type="text/javascript" src="{{ asset('plugins/summernote') }}/summernote-bs4.min.js"></script>
<script type="text/javascript" src="{{ asset('plugins/dropify') }}/dist/js/dropify.min.js"></script>
<script type="text/javascript">
    $(".summernote").summernote({
        height:500,
        callbacks: {
        // callback for pasting text only (no formatting)
            onPaste: function (e) {
              var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
              e.preventDefault();
              bufferText = bufferText.replace(/\r?\n/g, '<br>');
              document.execCommand('insertHtml', false, bufferText);
            }
        }
    })

    $(".summernote").on("summernote.enter", function(we, e) {
        $(this).summernote("pasteHTML", "<br><br>");
        e.preventDefault();
    });

    $('.dropify').dropify({
        messages: {
            default: 'Drag atau Drop untuk memilih gambar',
            replace: 'Ganti',
            remove:  'Hapus',
            error:   'error'
        }
    });

    $('.title').keyup(function(){
        var title = $(this).val().toLowerCase().replace(/[&\/\\#^, +()$~%.'":*?<>{}]/g,'-');
        $('.slug').val(title);
    });
</script>
@endpush