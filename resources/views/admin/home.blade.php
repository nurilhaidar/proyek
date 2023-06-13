@extends('admin.layout.template')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="h3 mb-2 text-gray-800">Dashboard</h1>
                </div>
                {{-- <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Beranda Page</li>
                        </ol>
                    </div> --}}
            </div>
            <div class="row">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Peminjaman 7 Hari Terakhir</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pinjam }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total Peminjaman</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-layer-group fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <a href="{{ url('administrator/peminjaman%blm%konfirm') }}"
                        class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Belum Dikonfirmasi
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $statusKonfirmasi }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-times-circle fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <a href="{{ url('administrator/peminjaman%blm%kembali') }}"
                        class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Belum Dikembalikan</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $statusKembali }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-times-circle fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom_js')
    <script>
        alert('Selamat Datang')
    </script>
@endpush
