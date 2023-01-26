@extends('layouts.frontend.app',[
    'title' => 'List Artikel',
])
@section('content')
<!-- ##### Agenda Area Start ##### -->
<div class="clever-catagory blog-details bg-img d-flex align-items-center justify-content-center p-3 height-400" style="background-image: url({{ asset('img/bg/agenda.png') }});">
    <div class="blog-details-headline">
        <h3>{{ $agenda->judul }}</h3>
    </div>
</div>

<!-- ##### Blog Details Content ##### -->
<div class="blog-details-content section-padding-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <!-- Blog Details Text -->
                <div class="blog-details-text">
                    {!! $agenda->deskripsi !!}
                </div>
            </div>
        </div>
    </div>
</div>
@stop