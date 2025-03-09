@extends('layouts.dash')
@section('title', 'Procesando deposito')
@section('content')
<!-- Page title -->
<div class="page-title">
    <div class="row justify-content-between align-items-center">
        <div class="mb-3 col-md-6 mb-md-0">
            <h5 class="mb-0 text-white h3 font-weight-400">Procesando deposito</h5>
        </div>
    </div>
</div>
<x-danger-alert />
<x-success-alert />
<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-body">

            <div class="card-title" id="enCola">En cola: {{ $deposits->count() }}</div>

                <livewire:proceso-deposito :depositId="$deposit->id" />    

            </div>
        </div>
    </div>
</div>
@parent

@include('purpose.user.script')

@endsection