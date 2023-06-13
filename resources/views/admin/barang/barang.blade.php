@extends('admin.layout.template')
@section('content')
    <div id="content">
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Tabel Barang</h1>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <a href="{{ url('administrator/inventaris/create') }}" class="btn btn-success">Tambah Data</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang</th>
                                    <th>Nama </th>
                                    <th>No Inventaris</th>
                                    <th>Sumber Dana</th>
                                    <th>Stok</th>
                                    <th>Kondisi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($br->count() > 0)
                                    @foreach ($br as $index => $b)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $b->id }}</td>
                                            <td>{{ $b->nama }}</td>
                                            <td>{{ $b->no_inventaris }}</td>
                                            <td>{{ $b->sumber_dana }}</td>
                                            <td>{{ $b->stok }} {{ $b->satuan }}</td>
                                            <td>{{ $b->kondisi }}</td>
                                            <td>
                                                <div style="display: flex">
                                                    {{-- show --}}
                                                    <a href="{{ url('/administrator/inventaris/' . $b->id) }}"
                                                        class="btn btn-sm btn-primary" style="margin-right: 5px">
                                                        <i class="fas fa-fw fa-eye"></i>
                                                    </a>
                                                    {{-- edit --}}
                                                    <a href="{{ url('/administrator/inventaris/' . $b->id . '/edit') }}"
                                                        class="btn btn-sm btn-warning" style="margin-right: 5px">
                                                        <i class="fas fa-fw fa-pen"></i>
                                                    </a>
                                                    {{-- delete --}}
                                                    <form method="POST"
                                                        action="{{ url('/administrator/inventaris/' . $b->id) }}">
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
                                        <td colspan="6" class="text-center">Data tidak ada</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
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
