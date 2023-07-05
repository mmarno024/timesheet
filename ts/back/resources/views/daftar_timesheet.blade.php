<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Timesheet</title>
    <link rel="icon" href="{{ url('public/assets/images/favicon2.png') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.0.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('public/assets/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <style>
        table {
            border-collapse: separate !important;
            border-spacing: 0 !important;
        }
        table tr th,
        table tr td {
            border-right: 1px solid #dee2e6 !important;
            border-bottom: 1px solid #dee2e6 !important;
        }
        table tr th:first-child,
        table tr td:first-child {
            border-left: 1px solid #dee2e6 !important;
        }
        table tr th {
            border-top: 1px solid #dee2e6 !important;
        }
        table tr:first-child th:first-child {
            border-top-left-radius: 0.30rem !important;
        }
        table tr:first-child th:last-child {
            border-top-right-radius: 0.30rem !important;
        }
        table tr:last-child td:first-child {
            border-bottom-left-radius: 0.30rem !important;
        }
        table tr:last-child td:last-child {
            border-bottom-right-radius: 0.30rem !important;
        }
    </style>
</head>

<body class="bg-info" style="background-image: url('public/assets/images/background2.png');background-repeat: no-repeat;background-position: left top;">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ url('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('daftar_timesheet') }}" class="">Timesheet</a>
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
                        <h5>Daftar Timesheet</h5>
                    </div>
                    <div class="card-body text-left">
                        <a href="{{ url('input_timesheet') }}" class="btn rounded btn-success btn-sm text-white"><i class="fa fa-pencil-square-o"></i> Tambah data timesheet</a><p></p>
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm table-condensed rounded" style="font-size:14px;">
                                <thead>
                                    <tr style="background:#aaaeab;">
                                        <th style="text-align:center">No</th>
                                        <th style="text-align:center">Jenis</th>
                                        <th style="text-align:center">Kode</th>
                                        <th style="text-align:center">User Input</th>
                                        <th style="text-align:center">Tanggal Input</th>
                                        <th style="text-align:center">Customer</th>
                                        <th style="text-align:center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_ts as $key => $value)
                                        <tr>
                                            <td align="center" style="text-align:center">{{ $key + $data_ts->firstItem() }}</td>
                                            <td align="center">{{ $value->jenis_ts }}</td>
                                            <td>{{ $value->kd_ts }}</td>
                                            <td align="center">{{ $value->rel_userid->name }}</td>
                                            <td align="center">{{ $value->tanggal_ts }}</td>
                                            <td>{{ $value->customer }}</td>
                                            <td align="center">
                                                <a class="btn rounded btn-info btn-sm" style="padding:0 10px;font-size:14px;" href="detail_timesheet/{{ $value->id }}">Detail</a>
                                                <a class="btn rounded btn-warning btn-sm text-white" style="padding:0 10px;font-size:14px;" href="edit_timesheet/{{ $value->id }}">Ubah</a>
                                                <form action="delete_timesheet/{{ $value->id }}" method="GET" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn rounded btn-danger btn-sm" style="padding:0 10px;font-size:14px;" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" href="detail/{{ $value->id }}">Hapus</button>
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
</body>
</html>