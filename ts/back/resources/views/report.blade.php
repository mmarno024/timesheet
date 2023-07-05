<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report</title>
    <link rel="icon" href="{{ url('public/assets/images/favicon2.png') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.0.0/css/font-awesome.min.css">
</head>

<body class="bg-info"
    style="background-image: url('public/assets/images/background2.png');background-repeat: no-repeat;background-position: left top;">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ url('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('register') }}" class>Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Report</a>
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
                        <h5>Report Table</h5>
                    </div>
                    <div class="card-body text-left">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm" style="font-size:14px;">
                                <thead>
                                    <tr>
                                        <th style="text-align:center">No</th>
                                        <th style="text-align:center">Instansi</th>
                                        <th style="text-align:center">Token</th>
                                        <th style="text-align:center">Status</th>
                                        <th style="text-align:center">Detail</th>
                                        <th style="text-align:center">Edit</th>
                                        <th style="text-align:center">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataUser as $key => $value)
                                        <tr>
                                            <td style="text-align:center">{{ $key + $dataUser->firstItem() }}</td>
                                            <td>{{ $value->name }} <p>
                                                    <span class="badge rounded-0 badge-info">{{ $value->user }}</span>
                                            </td>
                                            <td>{{ $value->token }}</td>
                                            <td>
                                                <?php if ($value->status == 'AKTIF' || $value->status ==
                                                'Aktif') { ?>
                                                <span
                                                    class="badge rounded-0 badge-success">{{ $value->status }}</span>
                                                <?php } else { ?>
                                                <span class="badge rounded-0 badge-danger">{{ $value->status }}</span>
                                                <?php } ?>
                                                <p> <span class="text-danger">{{ $value->expired_date }}</span>
                                            </td>
                                            <td class="text-center">
                                                <a class="btn rounded-0 btn-info btn-sm"
                                                    href="detail/{{ $value->id }}"><i
                                                        class="fa fa-search-plus"></i></a>
                                            </td>
                                            <td class="text-center">
                                                <a class="btn rounded-0 btn-warning btn-sm"
                                                    href="edit/{{ $value->id }}"><i class="fa fa-pencil"></i></a>
                                            </td>
                                            <td class="text-center">
                                                <form action="hapus/{{ $value->id }}" method="GET">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn rounded-0 btn-danger btn-sm"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i
                                                            class="fa fa-trash-o"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $dataUser->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
