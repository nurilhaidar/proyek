@extends('admin.layout.template')
@section('content')
    <div id="content">
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <form action="{{ url('administrator/cetak') }}" method="GET">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tanggal Awal</label>
                            <input type="date" name="tanggal_awal" class="form-control"
                                value="{{ isset($tanggal_awal) ? $tanggal_awal : '' }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tanggal Akhir</label>
                            <input type="date" name="tanggal_akhir" class="form-control"
                                value="{{ isset($tanggal_akhir) ? $tanggal_akhir : '' }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-success" style="margin-top: 33px">Search</button>
                    </div>
                </div>
            </form>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Peminjam</th>
                                    <th>OKI</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($data)
                                    @if ($data->count() > 0)
                                        @foreach ($data as $p)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $p->nama_peminjam }}</td>
                                                <td>{{ $p->asal_oki }}</td>
                                                <td>{{ date('d-m-Y', strtotime($p->tanggal_pinjam)) }}</td>
                                                <td>{{ date('d-m-Y', strtotime($p->tanggal_kembali)) }}</td>
                                                <td>{{ $p->status->status }}</td>
                                                <td>{{ $p->status->keterangan }}</td>
                                                <td>
                                                    <div style="display: flex">
                                                        {{-- show --}}
                                                        <a href="{{ url('/administrator/peminjaman/' . $p->id) }}"
                                                            class="btn btn-sm btn-primary" style="margin-right: 5px"><i
                                                                class="fas fa-fw fa-eye"></i></a>
                                                        {{-- delete --}}
                                                        <form method="POST"
                                                            action="{{ url('/administrator/peminjaman/' . $p->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger"
                                                                onclick="confirmDelete()">
                                                                <i class="fas fa-fw fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8" class="text-center">Data tidak ada</td>
                                        </tr>
                                    @endif
                                @endisset
                            </tbody>
                        </table>
                        <form action="{{ url('administrator/cetak_pdf') }}" method="GET">
                            <input type="text" name="tanggal_awal" hidden value="{{ $tanggal_awal }}">
                            <input type="text" name="tanggal_akhir" hidden value="{{ $tanggal_akhir }}">
                            <button class="btn btn-primary">Cetak</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom_css')
    <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
@push('custom_js')
    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/js/demo/datatables-demo.js') }}"></script>
@endpush
