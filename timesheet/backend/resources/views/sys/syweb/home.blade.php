@extends('layouts.colorparalax')
@section('content')
<!-- begin #home -->
<div id="home" class="content has-bg home">
    <div class="content-bg">
        <img src="{{url('colorparalax')}}/assets/img/home-bg.jpg" alt="Home" />
    </div>
        <div class="container home-content">
            <h1>{{\App\Sf::getParsys('APP_LABEL')}}</h1>
            <h3>{{\App\Sf::getParsys('APP_WEB_COMPANY_NAME')}}</h3>
            <p>{{\App\Sf::getParsys('APP_WEB_HOME_HTML')}}</p>
            <a href="{{\Auth::check()?url('home'):url('login')}}" class="btn btn-theme">{{\Auth::check()?'Admin Page':'SIGN IN'}}</a><br />
            <br />
            or <a href="#">subscribe</a> newsletter
        </div>
    </div>
    @endsection