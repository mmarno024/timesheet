@extends('layouts.master')
@section('content')
<div class="row">


    <div id="appCapsule">
        <div class="section wallet-card-section pt-1">
            <div class="wallet-card">
                <div class="balance">
                    <div class="left">
                        <span class="title">Total Timesheet yang anda simpan</span>
                        <h1 class="total">50</h1>
                    </div>
                </div>
                <div class="wallet-footer">
                    <div class="item">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#withdrawActionSheet">
                            <div class="icon-wrapper bg-danger">
                                <i class="fa-solid fa-arrow-up"></i>
                            </div>
                            <strong>Withdraw</strong>
                        </a>
                    </div>
                    <div class="item">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#sendActionSheet">
                            <div class="icon-wrapper">
                                <i class="fa-solid fa-arrow-right"></i>
                            </div>
                            <strong>Send</strong>
                        </a>
                    </div>
                    <div class="item">
                        <a href="app-cards.html">
                            <div class="icon-wrapper bg-success">
                                <i class="fa-solid fa-credit-card"></i>
                            </div>
                            <strong>Cards</strong>
                        </a>
                    </div>
                    <div class="item">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#exchangeActionSheet">
                            <div class="icon-wrapper bg-warning">
                                <i class="fa-solid fa-arrow-right-arrow-left"></i>
                            </div>
                            <strong>Exchange</strong>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection