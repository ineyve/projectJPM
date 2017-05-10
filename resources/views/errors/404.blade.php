@extends('master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">404 - Not Found</div>
                <div class="panel-body">
                    <div class="home-counter">
                        <h2>This page does not exist.</h2>
                        <br><br><br><br><br><br>
                        <header class="header"><h1 class="glitched">404</h1></header>
                    </div>
                </div>
                <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
                <script src="/glitched_text/js/index.js"></script>
            </div>
        </div>
    </div>
</div>
@endsection
@push('styles')
    <link rel="stylesheet" href="/glitched_text/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
@endpush