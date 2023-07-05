<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Instalasi</title>
    <link rel="icon" href="{{ url('public/assets/images/favicon2.png') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.0.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-info" style="background-image: url('public/assets/images/background2.png');background-repeat: no-repeat;background-position: left top;">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ url('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" class>Instalasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('daftar_service') }}" class>Service</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('report') }}">Report</a>
                    </li>
                </ul>
                <ul class="d-flex  me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a href="{{ route('logout') }}" class="btn btn-inverse rounded-0 text-danger">Sign Out</a>
                    </li>
                </ul>
            </div>
        </nav>
        
        <div class="col-sm-12 mt-3 mb-5 p-0">
            <div class="card-deck">
                <div class="card rounded-0">
                    <div class="card-header text-left">
                        <h5>Daftar Instalasi</h5>
                    </div>
                    <div class="card-body text-left">
                        <a href="{{ url('input_instalasi') }}" class="btn rounded-0 btn-success btn-sm text-white"><i class="fa fa-pencil-square-o"></i> Tambah data timesheet</a><p></p>
                        {{-- <a class="btn rounded-0 btn-success btn-sm text-white" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil-square-o"></i> Tambah data timesheet</a><p></p> --}}
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm" style="font-size:14px;">
                                <thead>
                                    <tr>
                                        <th style="text-align:center">No</th>
                                        <th style="text-align:center">Kode</th>
                                        <th style="text-align:center">User</th>
                                        <th style="text-align:center">Tanggal</th>
                                        <th style="text-align:center">Konsumen</th>
                                        <th style="text-align:center">Detail</th>
                                        <th style="text-align:center">Edit</th>
                                        <th style="text-align:center">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_ts as $key => $value)
                                        <tr>
                                            <td style="text-align:center">{{ $key + $data_ts->firstItem() }}</td>
                                            <td>{{ $value->kd_ts }}</td>
                                            <td>{{ $value->rel_userid->name }}</td>
                                            <td>{{ $value->tanggal_ts }}</td>
                                            <td>{{ $value->rel_d_instalasi[0]->konsumen }}</td>
                                            <td class="text-center">
                                                <a class="btn rounded-0 btn-info btn-sm" href="detail/{{ $value->id }}"><i class="fa fa-search-plus"></i></a>
                                            </td>
                                            <td class="text-center">
                                                <a class="btn rounded-0 btn-warning btn-sm" href="edit_instalasi/{{ $value->id }}"><i class="fa fa-pencil"></i></a>
                                            </td>
                                            <td class="text-center">
                                                <form action="delete_instalasi/{{ $value->id }}" method="GET">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn rounded-0 btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="fa fa-trash-o"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $data_ts->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="font-weight: normal;font-size:16px;">Pilihan pengisian</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-center">
                    <a type="button" class="btn btn-primary btn-sm" href="{{ url('daftar_instalasi') }}"><i class="fa fa-pencil-square-o"></i> Isi data secara manual</a>
                    <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"></i> Isi data langsung pada sistem</button>
                    <p>
                        <table width="100%" border="0">
                            <tr>
                                <td style="text-align: left;font-size:14px;">
                                    <b>Isi data secara manual :</b> User mengisikan data tulis tangan pada form hardcopy lalu discan/difoto dan unggah bersama foto - foto progres pekerjaan
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: left;font-size:14px;">
                                    <b>Isi data langsung pada sistem :</b> User mengisikan data langsung pada sistem dan unggah foto - foto progres pekerjaan
                                </td>
                            </tr>
                        </table>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>