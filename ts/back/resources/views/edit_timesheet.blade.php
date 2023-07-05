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
                        <h5>Form Input Timesheet</h5>
                    </div>
                    <form action="{{ route('update_timesheet') }}" method="post" enctype="multipart/form-data">
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
                            <div class="col-lg-12 col-12" style="margin:0;padding:0;">
                                <div class="col-lg-2 col-12" style="margin-bottom:10px;">
                                    <b>TANGGAL INPUT : </b>
                                    <input type="date" value="{{ $dataTs->tanggal_ts }}" name="tanggal_ts" id="tanggal_ts" class="form-control input-sm" required readonly style="padding:5px;font-size:14px;">
                                </div>
                                <div class="col-lg-4 col-12" style="margin-bottom:10px;">
                                    <b>JENIS TIMESHEET : </b>
                                    <select name="jenis_ts" id="jenis_ts" class="form-control input-sm" required style="padding:5px;font-size:14px;">
                                        <option value="">- Pilih -</option>
                                        <option value="INSTALLATION" {{ $dataTs->jenis_ts == 'INSTALLATION' ? 'selected' : '' }}>INSTALLATION</option>
                                        <option value="SERVICE" {{ $dataTs->jenis_ts == 'SERVICE' ? 'selected' : '' }}>SERVICE</option>
                                    </select>
                                </div>
                                <div class="col-lg-8 col-12" style="margin-bottom:10px;">
                                    <b>NAMA CUSTOMER : </b>
                                    <input type="text" value="{{ $dataTs->customer }}" name="customer" id="customer" class="form-control input-sm" required style="padding:5px;font-size:14px;">
                                </div>
                            </div>
                            <div class="col-lg-12 col-12">
                                <div class="table-responsive">
                                    <table width="100%" class="table table-borderless" style="font-weight: normal;">
                                        <tr>
                                            <th align="center" colspan="3" style="font-weight:bold;background:#aaaeab;text-align:center">
                                                UPLOAD FORM / FILE
                                            </th>
                                        </tr>
                                        <tr>
                                            <td style="margin:0;padding:10px;">
                                                <div class="col-12">FORM LUAR KOTA</div>
                                                <div class="col-12">
                                                    <input type="file" name="form_lk" id="form_lk" required/>
                                                    @if ($errors->has('files'))
                                                        @foreach ($errors->get('files') as $error)
                                                            <span class="invalid-feedback" role="alert"><strong>{{ $error }}</strong></span>
                                                        @endforeach
                                                    @endif
                                                    <div style="border:1px dotted #fff;text-align:left">
                                                        {{-- <img src="{{ url('public') }}/{{$dataTs->rel_d_timesheet[0]->path_lk}}" width="100px" style="margin-left:10px"> --}}
                                                        <i class="fa fa-file"></i> {{$dataTs->rel_d_timesheet[0]->form_lk}}
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="margin:0;padding:10px;">
                                                <div class="col-12">FORM PEMASANGAN/SERVICE</div>
                                                <div class="col-12">
                                                    <input type="file" name="form_instal_service" id="form_instal_service" required/>
                                                    @if ($errors->has('files'))
                                                        @foreach ($errors->get('files') as $error)
                                                            <span class="invalid-feedback" role="alert"><strong>{{ $error }}</strong></span>
                                                        @endforeach
                                                    @endif
                                                    <div style="border:1px dotted #fff;text-align:left">
                                                        <i class="fa fa-file"></i> {{$dataTs->rel_d_timesheet[0]->form_instal_service}}
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="margin:0;padding:10px;">
                                                <div class="col-12">FORM CHECKLIST</div>
                                                <div class="col-12">
                                                    <input type="file" name="form_checklist" id="form_checklist" required/>
                                                    @if ($errors->has('files'))
                                                        @foreach ($errors->get('files') as $error)
                                                            <span class="invalid-feedback" role="alert"><strong>{{ $error }}</strong></span>
                                                        @endforeach
                                                    @endif
                                                    <div style="border:1px dotted #fff;text-align:left">
                                                        <i class="fa fa-file"></i> {{$dataTs->rel_d_timesheet[0]->form_checklist}}
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-12 col-12"><b>KETERANGAN TAMBAHAN :</b></div>
                            <div class="col-lg-12 col-12">
                                <div class="table-responsive">
                                    <textarea class="form-control" name="note" id="tinymce" style="border-radius: 0;">{{ $dataTs->rel_d_timesheet[0]->note }}</textarea>
                                </div>
                            </div>
                            <p>&nbsp;</p>
                            <div class="col-lg-12 col-12">
                                <div class="table-responsive">
                                    <table width="100%" class="table table-bordered rounded" style="font-weight: normal;">
                                        <tr>
                                            <th align="center" colspan="3" style="font-weight:bold;background:#aaaeab;text-align:center">
                                                UPLOAD FOTO-FOTO PROGRES
                                            </th>
                                        </tr>
                                        <tr>
                                            <td style="margin:0;padding:10px;">
                                                <div class="col-3" style="float: left;">1. FOTO PROGRES 0 %</div>
                                                <div class="col-3" style="float: left;">
                                                    <input type="file" name="foto0[]" id="foto0" multiple accept="image/*" required/>
                                                    @if ($errors->has('files'))
                                                        @foreach ($errors->get('files') as $error)
                                                            <span class="invalid-feedback" role="alert"><strong>{{ $error }}</strong></span>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="col-6" style="float:left">
                                                    <div class="images-preview0" style="border:1px dotted #fff;text-align:left"></div>
                                                    <div style="border:1px dotted #fff;text-align:left">
                                                        @foreach($dataTs->rel_d_timesheet_img0 as $key => $value)
                                                            <img src="{{ url('public') }}/{{$value->path}}" width="100px" style="margin-left:10px">
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="margin:0;padding:10px;">
                                                <div class="col-3" style="float: left;">2. FOTO PROGRES 25 %</div>
                                                <div class="col-3" style="float: left;">
                                                    <input type="file" name="foto25[]" id="foto25" multiple accept="image/*" required/>
                                                    @if ($errors->has('files'))
                                                        @foreach ($errors->get('files') as $error)
                                                            <span class="invalid-feedback" role="alert"><strong>{{ $error }}</strong></span>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="col-6" style="float:left">
                                                    <div class="images-preview25" style="border:1px dotted #fff;text-align:left"></div>
                                                    <div style="border:1px dotted #fff;text-align:left">
                                                        @foreach($dataTs->rel_d_timesheet_img25 as $key => $value)
                                                            <img src="{{ url('public') }}/{{$value->path}}" width="100px" style="margin-left:10px">
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="margin:0;padding:10px;">
                                                <div class="col-3" style="float: left;">3. FOTO PROGRES 50 %</div>
                                                <div class="col-3" style="float: left;">
                                                    <input type="file" name="foto50[]" id="foto50" multiple accept="image/*" required/>
                                                    @if ($errors->has('files'))
                                                        @foreach ($errors->get('files') as $error)
                                                            <span class="invalid-feedback" role="alert"><strong>{{ $error }}</strong></span>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="col-6" style="float:left">
                                                    <div class="images-preview50" style="border:1px dotted #fff;text-align:left"></div>
                                                    <div style="border:1px dotted #fff;text-align:left">
                                                        @foreach($dataTs->rel_d_timesheet_img50 as $key => $value)
                                                            <img src="{{ url('public') }}/{{$value->path}}" width="100px" style="margin-left:10px">
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="margin:0;padding:10px;">
                                                <div class="col-3" style="float: left;">4. FOTO PROGRES 75 %</div>
                                                <div class="col-3" style="float: left;">
                                                    <input type="file" name="foto75[]" id="foto75" multiple accept="image/*" required/>
                                                    @if ($errors->has('files'))
                                                        @foreach ($errors->get('files') as $error)
                                                            <span class="invalid-feedback" role="alert"><strong>{{ $error }}</strong></span>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="col-6" style="float:left">
                                                    <div class="images-preview75" style="border:1px dotted #fff;text-align:left"></div>
                                                    <div style="border:1px dotted #fff;text-align:left">
                                                        @foreach($dataTs->rel_d_timesheet_img75 as $key => $value)
                                                            <img src="{{ url('public') }}/{{$value->path}}" width="100px" style="margin-left:10px">
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="margin:0;padding:10px;">
                                                <div class="col-3" style="float: left;">5. FOTO PROGRES 100 %</div>
                                                <div class="col-3" style="float: left;">
                                                    <input type="file" name="foto100[]" id="foto100" multiple accept="image/*" required/>
                                                    @if ($errors->has('files'))
                                                        @foreach ($errors->get('files') as $error)
                                                            <span class="invalid-feedback" role="alert"><strong>{{ $error }}</strong></span>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="col-6" style="float:left">
                                                    <div class="images-preview100" style="border:1px dotted #fff;text-align:left"></div>
                                                    <div style="border:1px dotted #fff;text-align:left">
                                                        @foreach($dataTs->rel_d_timesheet_img100 as $key => $value)
                                                            <img src="{{ url('public') }}/{{$value->path}}" width="100px" style="margin-left:10px">
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="margin:0;padding:10px;">
                                                <div class="col-3" style="float: left;">6. FOTO TAMBAHAN (LAIN - LAIN)</div>
                                                <div class="col-3" style="float: left;">
                                                    <input type="file" name="fotox[]" id="fotox" multiple accept="image/*"/>
                                                    @if ($errors->has('files'))
                                                        @foreach ($errors->get('files') as $error)
                                                            <span class="invalid-feedback" role="alert"><strong>{{ $error }}</strong></span>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="col-6" style="float:left">
                                                    <div class="images-previewx" style="border:1px dotted #fff;text-align:left"></div>
                                                    <div style="border:1px dotted #fff;text-align:left">
                                                        @foreach($dataTs->rel_d_timesheet_imgx as $key => $value)
                                                            <img src="{{ url('public') }}/{{$value->path}}" width="100px" style="margin-left:10px">
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-12 col-12">
                                <div class="table-responsive">
                                    <i style="color:red"><b>Keterangan upload gambar : </b>Block semua gambar yang ingin ditambahkan lalu klik open dan simpan timesheet</i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-block">Simpan timesheet</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script >
        $(function() {
            var previewImages0 = function(input, imgPreviewPlaceholder) {
                if (input.files) {
                    var filesAmount = input.files.length;
                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();
                        reader.onload = function(event) {
                            $($.parseHTML('<img width="70" style="margin-left:10px">')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                        }
                        reader.readAsDataURL(input.files[i]);
                    }
                }
                };
                $('#foto0').on('change', function() {
                previewImages0(this, 'div.images-preview0');
            });
            var previewImages25 = function(input, imgPreviewPlaceholder) {
                if (input.files) {
                    var filesAmount = input.files.length;
                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();
                        reader.onload = function(event) {
                            $($.parseHTML('<img width="70" style="margin-left:10px">')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                        }
                        reader.readAsDataURL(input.files[i]);
                    }
                }
                };
                $('#foto25').on('change', function() {
                previewImages25(this, 'div.images-preview25');
            });
            var previewImages50 = function(input, imgPreviewPlaceholder) {
                if (input.files) {
                    var filesAmount = input.files.length;
                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();
                        reader.onload = function(event) {
                            $($.parseHTML('<img width="70" style="margin-left:10px">')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                        }
                        reader.readAsDataURL(input.files[i]);
                    }
                }
                };
                $('#foto50').on('change', function() {
                previewImages50(this, 'div.images-preview50');
            });
            var previewImages75 = function(input, imgPreviewPlaceholder) {
                if (input.files) {
                    var filesAmount = input.files.length;
                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();
                        reader.onload = function(event) {
                            $($.parseHTML('<img width="70" style="margin-left:10px">')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                        }
                        reader.readAsDataURL(input.files[i]);
                    }
                }
                };
                $('#foto75').on('change', function() {
                previewImages75(this, 'div.images-preview75');
            });
            var previewImages100 = function(input, imgPreviewPlaceholder) {
                if (input.files) {
                    var filesAmount = input.files.length;
                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();
                        reader.onload = function(event) {
                            $($.parseHTML('<img width="70" style="margin-left:10px">')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                        }
                        reader.readAsDataURL(input.files[i]);
                    }
                }
                };
                $('#foto100').on('change', function() {
                previewImages100(this, 'div.images-preview100');
            });
            var previewImagesx = function(input, imgPreviewPlaceholder) {
                if (input.files) {
                    var filesAmount = input.files.length;
                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();
                        reader.onload = function(event) {
                            $($.parseHTML('<img width="70" style="margin-left:10px">')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                        }
                        reader.readAsDataURL(input.files[i]);
                    }
                }
                };
                $('#fotox').on('change', function() {
                previewImagesx(this, 'div.images-previewx');
            });
        });
        tinymce.init({
            selector: 'textarea#tinymce',
            height: 300
        });
    </script>
</body>
</html>