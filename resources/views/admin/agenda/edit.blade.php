@extends('layouts.backend.app',[
    'title' => 'Edit Agenda',
    'contentTitle' => 'Edit Agenda'
])

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/summernote') }}/summernote-bs4.min.css">
@endpush

@section('content')
<div class="">    
    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.agenda.index') }}" class="btn btn-success btn-sm">Kembali</a>
        </div>
        <div class="card-body">
        <form method="POST" enctype="multipart/form-data" action="{{ route('admin.agenda.update',$jadwalKegiatan->id) }}">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="uraian">Uraian Kegiatan</label>
                <input required="" type="" name="uraian" id="uraian" placeholder="" class="form-control title" value="{{ $jadwalKegiatan->uraian }}"> 
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <input required="" type="" name="keterangan" id="keterangan" placeholder="" class="form-control title" value="{{ $jadwalKegiatan->keterangan }}"> 
            </div>
            
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="tanggal_awal">Tanggal Mulai</label>
                        <input value="{{ $jadwalKegiatan->tanggal_awal }}" type="date" name="tanggal_awal" id="tanggal_awal" class="form-control">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="tanggal_akhir">Tanggal Selesai</label>
                        <input value="{{ $jadwalKegiatan->tanggal_akhir }}" type="date" name="tanggal_akhir" id="tangal_akhir" class="form-control">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sm">UPDATE</button>    
            </div> 
        </div>
        </form>
    </div>
</div>
@stop

@push('js')
<script type="text/javascript" src="{{ asset('plugins/summernote') }}/summernote-bs4.min.js"></script>
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
</script>
@endpush