@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-shopping-cart"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total Penjualan</span>
                <span class="info-box-number">{{$penjualan}}</span>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
