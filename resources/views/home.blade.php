@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3">
            <city-search></city-search>
        </div>
        <div class="col-9">
            <main-card></main-card>
        </div>
    </div>
    <div class="row">
        <city-weather></city-weather>
    </div>
</div>
@endsection
