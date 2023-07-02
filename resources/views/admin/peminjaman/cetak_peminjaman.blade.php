<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">

    @stack('custom_css')

</head>

<body>
    <div id="content" class="container">
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <br>
            <h1 class="h3 mb-2 text-gray-800 text-center">Daftar Peminjaman</h1>

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
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
