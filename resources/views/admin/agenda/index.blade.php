@extends('layouts.backend.app', [
    'title' => 'Manage Agenda',
    'contentTitle' => 'Manage Agenda',
])
@push('css')
    <!-- DataTables -->
    <link rel="stylesheet"
        href="{{ asset('templates/backend/AdminLTE-3.0.1') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
@endpush
@section('content')
    <x-alert></x-alert>
    {{-- @php
        use Carbon\Carbon;
        $date=Carbon::translatedFormat('d F Y');
    @endphp --}}
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('admin.agenda.create') }}" class="btn btn-primary btn-sm">Tambah Data</a>
                </div>
                <div class="card-body table-responsive">
                    <table id="dataTable1" class="table table-bordered w-100">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Waktu Kegiatan</th>
                                <th>Uraian Kegiatan</th>
                                <th>Keterangan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwalKegiatan as $agenda)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{-- {{ date('d F Y', strtotime($agenda->tanggal_awal)) }} - {{ date('d F Y',strtotime($agenda->tanggal_akhir)) }} --}}
                                        {{ \Carbon\Carbon::parse($agenda->tanggal_awal)->translatedFormat('d F Y') }} -
                                        {{ \Carbon\Carbon::parse($agenda->tanggal_akhir)->translatedFormat('d F Y') }}
                                        @if (
                                            \Carbon\Carbon::parse($agenda->tanggal_awal)->translatedFormat('d F Y') ==
                                                \Carbon\Carbon::parse($agenda->tanggal_akhir)->translatedFormat('d F Y'))
                                            (1 hari)
                                        @endif
                                    </td>
                                    <td>{{ $agenda->uraian }}</td>
                                    <td>{{ $agenda->keterangan }}</td>
                                    
                                    <td class="align-middle text-center">
                                        <a href="{{ route('admin.agenda.edit', $agenda->id) }}"
                                            class="btn btn-primary btn-sm"><i class="fas fa-edit fa-fw"></i>
                                        </a>

                                        <form method="POST" action="{{ route('admin.agenda.destroy', $agenda->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Yakin hapus ?')" type="submit"
                                                class="btn btn-danger btn-sm ml-2"><i
                                                    class="fas fa-trash fa-fw"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
@push('js')
    <!-- DataTables -->
    <script src="{{ asset('templates/backend/AdminLTE-3.0.1') }}/plugins/datatables/jquery.dataTables.js"></script>
    <script src="{{ asset('templates/backend/AdminLTE-3.0.1') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.js">
    </script>
    <script>
        $(function() {
            $("#dataTable1").DataTable();
        });
    </script>
    {{-- <script type="text/javascript">
        $(document).on('click','#publish',function() {
            let param = {
                url: $(this).val(),
                title: "Publish?",
                text: "Agenda akan segera di publish pada pengumuman",
                icon:"info",
                type: 'PUT',
                swal: {
                    message: 'Berhasil!',
                    content: 'Data Berhasil Di Publish!',
                    status: 'success'
                }
            }
            segeraPublish(param);
        })

        $(document).on('click','#segeraPublish',function() {
            let param = {
                url: $(this).val(),
                title: "Batalkan Publikasi?",
                text: "Agenda akan di hapus dari status publish",
                icon:"info",
                type: 'PUT',
                swal: {
                    message: 'Berhasil!',
                    content: 'Data Berhasil Di Hapus Dari Status Segera Publish!',
                    status: 'success'
                }
            }
            segeraPublish(param);
        })
    </script> --}}
@endpush
