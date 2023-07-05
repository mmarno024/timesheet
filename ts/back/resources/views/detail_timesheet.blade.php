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
        .main {
            display: flex;
            flex-direction: row;
            padding: 5px;
        }
        .main div {
            margin: 10px 20px;
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
                        <h5>Form Detail Timesheet</h5>
                    </div>
                    
                    <div class="card-body text-left" style="font-size:14px;">
                        <div class="col-lg-12 col-12">
                            <div class="table-responsive">
                                <table width="100%" class="table table-condensed" style="font-weight: normal; border:none">
                                    <tr>
                                        <td width="20%">TANGGAL INPUT</td>
                                        <td width="2%">:</td>
                                        <td width="78%">{{ $dataTs->tanggal_ts }}</td>
                                    </tr>
                                    <tr>
                                        <td>USER INPUT</td>
                                        <td>:</td>
                                        <td>{{ $dataTs->rel_userid->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>JENIS TIMESHEET</td>
                                        <td>:</td>
                                        <td>{{ $dataTs->jenis_ts }}</td>
                                    </tr>
                                    <tr>
                                        <td>NAMA CUSTOMER</td>
                                        <td>:</td>
                                        <td>{{ $dataTs->customer }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        
                        <div class="col-lg-12 col-12">
                            <div class="table-responsive">
                                <table width="100%" class="table table-borderless" style="font-weight: normal;">
                                    <tr>
                                        <th align="center" colspan="3" style="font-weight:bold;background:#aaaeab;text-align:center">
                                            FORM / FILE YANG DIUPLOAD
                                        </th>
                                    </tr>
                                    <tr>
                                        <td style="margin:0;padding:10px;">
                                            <div class="col-12">FORM LUAR KOTA</div>
                                            <div class="col-12">
                                                <div style="text-align:left">
                                                    @if($dataTs->rel_d_timesheet[0]->ext_lk == 'xls' || $dataTs->rel_d_timesheet[0]->ext_lk == 'xlsx')
                                                        <img src="{{ url('public') }}/assets/images/xls.png" width="50px" style="margin-left:10px">
                                                    @elseif($dataTs->rel_d_timesheet[0]->ext_lk == 'pdf')
                                                        <img src="{{ url('public') }}/assets/images/pdf.png" width="50px" style="margin-left:10px">
                                                    @else
                                                        <img src="{{ url('public') }}/assets/images/img.png" width="50px" style="margin-left:10px">
                                                    @endif
                                                    <br/>
                                                    Filename : {{$dataTs->rel_d_timesheet[0]->form_lk}}
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <a style="text-decoration:none" href="{{url('xx')}}">
                                                    <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-download"></i> Download File</button>
                                                </a>
                                            </div>
                                        </td>
                                        <td style="margin:0;padding:10px;">
                                            <div class="col-12">FORM PEMASANGAN/SERVICE</div>
                                            <div class="col-12">
                                                <div style="text-align:left">
                                                    @if($dataTs->rel_d_timesheet[0]->ext_instal_service == 'xls' || $dataTs->rel_d_timesheet[0]->ext_instal_service == 'xlsx')
                                                        <img src="{{ url('public') }}/assets/images/xls.png" width="50px" style="margin-left:10px">
                                                    @elseif($dataTs->rel_d_timesheet[0]->ext_instal_service == 'pdf')
                                                        <img src="{{ url('public') }}/assets/images/pdf.png" width="50px" style="margin-left:10px">
                                                    @else
                                                        <img src="{{ url('public') }}/assets/images/img.png" width="50px" style="margin-left:10px">
                                                    @endif
                                                    <br/>
                                                    Filename : {{$dataTs->rel_d_timesheet[0]->form_instal_service}}
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <a style="text-decoration:none" href="{{url('xx')}}">
                                                    <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-download"></i> Download File</button>
                                                </a>
                                            </div>
                                        </td>
                                        <td style="margin:0;padding:10px;">
                                            <div class="col-12">FORM CHECKLIST</div>
                                            <div class="col-12">
                                                <div style="text-align:left">
                                                    @if($dataTs->rel_d_timesheet[0]->ext_checklist == 'xls' || $dataTs->rel_d_timesheet[0]->ext_checklist == 'xlsx')
                                                        <img src="{{ url('public') }}/assets/images/xls.png" width="50px" style="margin-left:10px">
                                                    @elseif($dataTs->rel_d_timesheet[0]->ext_checklist == 'pdf')
                                                        <img src="{{ url('public') }}/assets/images/pdf.png" width="50px" style="margin-left:10px">
                                                    @else
                                                        <img src="{{ url('public') }}/assets/images/img.png" width="50px" style="margin-left:10px">
                                                    @endif
                                                    <br/>
                                                    Filename : {{$dataTs->rel_d_timesheet[0]->form_checklist}}
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <a style="text-decoration:none" href="{{url('xx')}}">
                                                    <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-download"></i> Download File</button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="col-lg-12 col-12">
                            <div class="table-responsive">
                                <table width="100%" class="table table-condensed" style="font-weight: normal; border:none">
                                    <tr>
                                        <td width="20%">KETERANGAN TAMBAHAN :</td>
                                        <td width="2%">:</td>
                                        <td width="78%">{!! $dataTs->rel_d_timesheet[0]->note !!}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        
                        <div class="table-responsive">
                            <table width="100%" class="table table-borderless" style="font-weight: normal;">
                                <tr>
                                    <th align="center" colspan="3" style="font-weight:bold;background:#aaaeab;text-align:center">
                                        FORM / FILE YANG DIUPLOAD
                                    </th>
                                </tr>
                                <tr>
                                    <td style="margin:0;padding:10px;">
                                        <div class="col-3" style="float: left;">1. FOTO PROGRES 0 %</div>
                                        <div class="col-9" style="float:left">
                                            <div style="border:1px dotted #fff;text-align:left">
                                                @foreach($dataTs->rel_d_timesheet_img0 as $key => $value)
                                                    <div class="text-center" style="float:left">
                                                        <img src="{{ url('public') }}/{{$value->path}}" width="100px" style="margin-left:10px"><br/>
                                                        <button type="button" class="btn btn-danger btn-sm" style="margin-top:5px;padding:2px 5px;"><i class="fa fa-download"></i> Download</button>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="margin:0;padding:10px;">
                                        <div class="col-3" style="float: left;">2. FOTO PROGRES 25 %</div>
                                        <div class="col-9" style="float:left">
                                            <div style="border:1px dotted #fff;text-align:left">
                                                @foreach($dataTs->rel_d_timesheet_img25 as $key => $value)
                                                    <div class="text-center" style="float:left">
                                                        <img src="{{ url('public') }}/{{$value->path}}" width="100px" style="margin-left:10px"><br/>
                                                        <button type="button" class="btn btn-danger btn-sm" style="margin-top:5px;padding:2px 5px;"><i class="fa fa-download"></i> Download</button>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="margin:0;padding:10px;">
                                        <div class="col-3" style="float: left;">3. FOTO PROGRES 50 %</div>
                                        <div class="col-9" style="float:left">
                                            <div style="border:1px dotted #fff;text-align:left">
                                                @foreach($dataTs->rel_d_timesheet_img50 as $key => $value)
                                                <div class="text-center" style="float:left">
                                                    <img src="{{ url('public') }}/{{$value->path}}" width="100px" style="margin-left:10px"><br/>
                                                    <button type="button" class="btn btn-danger btn-sm" style="margin-top:5px;padding:2px 5px;"><i class="fa fa-download"></i> Download</button>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="margin:0;padding:10px;">
                                        <div class="col-3" style="float: left;">4. FOTO PROGRES 75 %</div>
                                        <div class="col-9" style="float:left">
                                            <div style="border:1px dotted #fff;text-align:left">
                                                @foreach($dataTs->rel_d_timesheet_img75 as $key => $value)
                                                <div class="text-center" style="float:left">
                                                    <img src="{{ url('public') }}/{{$value->path}}" width="100px" style="margin-left:10px"><br/>
                                                    <button type="button" class="btn btn-danger btn-sm" style="margin-top:5px;padding:2px 5px;"><i class="fa fa-download"></i> Download</button>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="margin:0;padding:10px;">
                                        <div class="col-3" style="float: left;">5. FOTO PROGRES 100 %</div>
                                        <div class="col-9" style="float:left">
                                            <div style="border:1px dotted #fff;text-align:left">
                                                @foreach($dataTs->rel_d_timesheet_img100 as $key => $value)
                                                <div class="text-center" style="float:left">
                                                    <img src="{{ url('public') }}/{{$value->path}}" width="100px" style="margin-left:10px"><br/>
                                                    <button type="button" class="btn btn-danger btn-sm" style="margin-top:5px;padding:2px 5px;"><i class="fa fa-download"></i> Download</button>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="margin:0;padding:10px;">
                                        <div class="col-3" style="float: left;">6. FOTO TAMBAHAN (LAIN - LAIN)</div>
                                        <div class="col-6" style="float:left">
                                            <div style="border:1px dotted #fff;text-align:left">
                                                @foreach($dataTs->rel_d_timesheet_imgx as $key => $value)
                                                <div class="text-center" style="float:left">
                                                    <img src="{{ url('public') }}/{{$value->path}}" width="100px" style="margin-left:10px"><br/>
                                                    <button type="button" class="btn btn-danger btn-sm" style="margin-top:5px;padding:2px 5px;"><i class="fa fa-download"></i> Download</button>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-12 col-12">&nbsp;</div>
                    </div>
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