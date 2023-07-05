@extends('layouts.coloradmin')
@section('title') @stop
@section('title-small') @stop
@section('breadcrumb')
@stop
@section('content')
    <?php
    $sf_version = '3.1.1';
    $arr = [
    [
    'subj' => 'Theme & Color',
    'desc' => 'Template skin, css packaged',
    'platform' => 'Color Admin',
    'version' => '2.0',
    ],
    [
    'subj' => 'Front End Framework',
    'desc' => 'Javascript logical programming front end',
    'platform' => 'Angular',
    'version' => '1.7',
    ],
    [
    'subj' => 'Back End Framework',
    'desc' => 'PHP logical programming back end / server side',
    'platform' => 'Laravel',
    'version' => app()::VERSION,
    ],
    [
    'subj' => 'Application Framework',
    'desc' => 'Combine many periperal in harmony',
    'platform' => 'Savetime Framework (SF)',
    'version' => $sf_version,
    ] /* [
    "subj" => "",
    "desc" => "",
    "platform" => "",
    "version" => "",
    */,
    ];
    ?>
    <!-- begin invoice -->
    <div class="invoice">
        <div class="invoice-company">
            <span class="pull-right hidden-print">
                <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-primary m-b-10"><i
                        class="fa fa-print m-r-5"></i> Print</a>
            </span>
            {{ \App\Sf::getParsys('APP_LABEL') }}
        </div>
        <div class="invoice-content">
            <div class="table-responsive">
                <table class="table table-invoice">
                    <thead>
                        <tr>
                            <th>TOOLS DESCRIPTION</th>
                            <th>PLATFORM</th>
                            <th>VERSION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($arr as $k => $v): ?>
                        <tr>
                            <td>
                                {{ $v['subj'] }}<br />
                                <small>{{ $v['desc'] }}</small>
                            </td>
                            <td>{{ $v['platform'] }}</td>
                            <td>{{ $v['version'] }}</td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="invoice-price">
                <div class="invoice-price-left">
                    <div class="invoice-price-row">
                        <div class="sub-price">
                            <small>BACKEND</small>
                            Laravel {{ app()::VERSION }}
                        </div>
                        <div class="sub-price">
                            <i class="fa fa-plus"></i>
                        </div>
                        <div class="sub-price">
                            <small>FRONTEND</small>
                            Angular 1.*
                        </div>
                    </div>
                </div>
                <div class="invoice-price-right" style="text-align: center;">
                    <small>MODULE</small> {{ \App\Sf::getParsys('APP_LABEL') }}
                </div>
            </div>
        </div>
        <div class="invoice-footer text-muted">
            <p class="text-center m-b-5">
                THANK YOU
            </p>
        </div>
    </div>
    <!-- end invoice -->
@endsection
