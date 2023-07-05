<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit</title>
    <link rel="icon" href="{{ url('public/assets/images/favicon2.png') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.0.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
                        <a class="nav-link active" href="{{ url('register') }}" class>Register</a>
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
                        <h5>Form Edit</h5>
                    </div>
                    <form action="{{ route('update') }}" method="post">
                        @csrf
                        <div class="card-body text-left" style="font-size:14px;">
                            @if (session('errors'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Something it's wrong:
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <input type="hidden" name="id" id="id" value="{{ $dataUser->id }}">
                            <div class="form-group input-group-sm col-sm-6 p-0">
                                <label for="user"><strong>User</strong></label>
                                <input type="text" name="user" id="user" class="form-control rounded-0"
                                    value="{{ $dataUser->user }}" readonly>
                            </div>
                            <label for="ip_address"><strong>IP Address</strong></label>
                            @foreach ($dataUser->rel_ip as $v)
                                <div id="ipRow">
                                    <div class="input-group input-group-sm col-sm-6 p-0 mb-1">
                                        <input type="text" name="ip_address[]" id="ip_address"
                                            class="form-control rounded-0 m-input" placeholder="Masukkan IP Address"
                                            autocomplete="off" value="{{ $v->ip_address }}">
                                        <div class="input-group-append">
                                            <button id="removeRow" type="button"
                                                class="btn btn-sm btn-danger rounded-0"><i
                                                    class="fa fa-trash-o"></i></button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div id="newIpRow"></div>
                            <button id="addIpRow" type="button" class="btn btn-sm btn-info rounded-0">Tambah ip
                                address</button>
                            <p></p>
                            <label for="id_instansi"><strong>Instansi</strong></label>
                            @foreach ($dataUser->rel_is as $v)
                                <div id="instansiRow">
                                    <div class="input-group input-group-sm col-sm-6 p-0 mb-1">
                                        <select class="form-control rounded-0" name="id_instansi[]" id="id_instansi"
                                            required>
                                            <option value="">- Pilih -</option>
                                            @foreach ($instansi as $key => $value)
                                                <option value="{{ $value->id_instansi }}"
                                                    {{ $v->id_instansi == $value->id_instansi ? 'selected' : '' }}>
                                                    {{ $value->id_instansi }} - {{ $value->nm_instansi }}</option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <button id="removeRow" type="button"
                                                class="btn btn-sm btn-danger rounded-0"><i
                                                    class="fa fa-trash-o"></i></button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div id="newInstansiRow"></div>
                            <button id="addInstansiRow" type="button" class="btn btn-sm btn-info rounded-0">Tambah
                                instansi</button>
                            <p></p>
                            <label for="hardware"><strong>ID Hardware</strong></label>
                            @foreach ($dataUser->rel_hw as $v)
                                <div id="hwRow">
                                    <div class="input-group input-group-sm col-sm-6 p-0 mb-1">
                                        <input type="text" name="hardware[]" id="hardware"
                                            class="form-control rounded-0 m-input" value="{{ $v->hardware }}"
                                            placeholder="Masukkan ID Hardware" autocomplete="off">
                                        <div class="input-group-append">
                                            <button id="removeRow" type="button"
                                                class="btn btn-sm btn-danger rounded-0"><i
                                                    class="fa fa-trash-o"></i></button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div id="newHwRow"></div>
                            <button id="addHwRow" type="button" class="btn btn-sm btn-info rounded-0">Tambah id
                                hardware</button>
                            <div class="form-group input-group-sm col-sm-6 p-0">
                                <label for=""><strong>Status</strong></label>
                                <select class="form-control rounded-0" name="status" id="status" required>
                                    <option value="Aktif" {{ $dataUser->status == 'Aktif' ? 'selected' : '' }}>Aktif
                                    </option>
                                    <option value="Nonaktif" {{ $dataUser->status == 'Nonaktif' ? 'selected' : '' }}>
                                        Nonaktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-block rounded-0">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<?php $arr_is = json_encode($instansi); ?>
<script type="text/javascript">
    var instansi = <?php echo $arr_is; ?>;    $("#addInstansiRow").click(function() {
        var html_instansi = '';
        html_instansi += '<div id="instansiRow">';
        html_instansi += '<div class="input-group input-group-sm col-sm-6 p-0 mb-1">';
        html_instansi +=
            '<select class="form-control rounded-0" name="id_instansi[]" id="id_instansi"><option value="">- Pilih -</option>';
        instansi.forEach(item => {
            html_instansi += '<option value="' + item.id_instansi + '">' + item.id_instansi + ' - ' +
                item
                .nm_instansi + '</option>';
        });
        html_instansi += '</select>';
        html_instansi += '<div class="input-group-append">';
        html_instansi +=
            '<button id="removeInstansiRow" type="button" class="btn btn-sm btn-danger rounded-0"><i class="fa fa-trash-o"></i></button>';
        html_instansi += '</div>';
        html_instansi += '</div>';
        $('#newInstansiRow').append(html_instansi);
    });
    $(document).on('click', '#removeInstansiRow', function() {
        $(this).closest('#instansiRow').remove();
    });
    $("#addIpRow").click(function() {
        var html_ip = '';
        html_ip += '<div id="ipRow">';
        html_ip += '<div class="input-group input-group-sm col-sm-6 p-0 mb-1">';
        html_ip +=
            '<input type="text" name="ip_address[]" id="ip_address" class="form-control rounded-0 m-input" placeholder="Masukkan IP Address" autocomplete="off">';
        html_ip += '<div class="input-group-append">';
        html_ip +=
            '<button id="removeIpRow" type="button" class="btn btn-sm btn-danger rounded-0"><i class="fa fa-trash-o"></i></button>';
        html_ip += '</div>';
        html_ip += '</div>';
        $('#newIpRow').append(html_ip);
    });
    $(document).on('click', '#removeIpRow', function() {
        $(this).closest('#ipRow').remove();
    });
    $("#addHwRow").click(function() {
        var html_hw = '';
        html_hw += '<div id="HwRow">';
        html_hw += '<div class="input-group input-group-sm col-sm-6 p-0 mb-1">';
        html_hw +=
            '<input type="text" name="hardware[]" id="hardware" class="form-control rounded-0 m-input" placeholder="Masukkan ID Hardware" autocomplete="off">';
        html_hw += '<div class="input-group-append">';
        html_hw +=
            '<button id="removeHwRow" type="button" class="btn btn-sm btn-danger rounded-0"><i class="fa fa-trash-o"></i></button>';
        html_hw += '</div>';
        html_hw += '</div>';
        $('#newHwRow').append(html_hw);
    });
    $(document).on('click', '#removeHwRow', function() {
        $(this).closest('#hwRow').remove();
    });

</script>

</html>
