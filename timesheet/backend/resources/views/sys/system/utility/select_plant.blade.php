@extends('layouts.coloradmin')
<!-- ------------------------------------------------------------------------------- -->
@section('title')Plant Selection @stop
<!-- ------------------------------------------------------------------------------- -->
@section('title-small') @stop
<!-- ------------------------------------------------------------------------------- -->
@section('breadcrumb')
<span>Select</span> @stop
<!-- ------------------------------------------------------------------------------- -->
@section('content')
<div class="panel">
	<div class="panel-body">
        <?php if ($syplant->count() == 0): ?>
            <div class="alert alert-warning">
                <i class="fa fa-warning fa-3x pull-left"></i>
                <b>Sorry!</b>
                <p>You haven't any plant allowed. Contact your administrator.</p>
            </div>
        <?php endif?>
		<?php foreach ($syplant as $k => $v): ?>
        <a href="javascript:;" onclick="SfSelectPlant('{{$v->plant}}')">
        	<span class="fa fa-5x pull-left">0{{$k+1}}</span>
            <?php if (Session::get('plant') == $v->plant): ?>
            <i class="fa fa-5x fa-check pull-right"></i>
            <?php endif?>
            <h4 class="text-success">{{$v->plant}}. {{$v->plantname}}, {{$v->provice}}, {{$v->state}}</h4>
            <p class="desc">
                Address : {{$v->addr}}, {{$v->city}}, {{$v->provice}}, {{$v->state}}  {{$v->postcode}}<br>
                Company : {{@$v->rel_com_code->com_name}}
            </p>
        </a>
        <hr>
	<?php endforeach?>
	</div>
</div>


@stop