@extends('master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">403 - Forbidden</div>
                <div class="panel-body">
                    <div class="home-counter"><h2>You are not allowed in this page.</h2></div>
                    <br><br><br><br><br><br>
                    <header class="header"><h3 class="glitched">403</h3></header>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('styles')
    <link rel="stylesheet" href="/glitched_text/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
@endpush