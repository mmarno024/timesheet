@extends('layouts.colorerror')
@section('title') @stop
@section('title-small') @stop
@section('breadcrumb')
@stop
@section('content')
    <div class="error">
        <div class="error-code m-b-10">{{ @$status == '' ? '404' : $status }} <i class="fa fa-warning"></i></div>
        <div class="error-content">
            <div class="error-message">{!! @$subj !!}</div>
            <div class="error-desc m-b-20">
                {!! @$body !!}
            </div>
            <div>
                <a href="{{ url('/') }}" class="btn btn-primary">Go Back to Home Page</a>
            </div>
        </div>
    </div>
@endsection
