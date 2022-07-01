@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
<section class="content">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title" style="margin-top:5px;">
        <i class="fas fa-list"></i> Aktivitas Toko
      </h3>
    </div>
    <div class="row" style="padding: 10px;">
      <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
          <div class="inner">
            <h3>Rp {{ $total }}</h3>
            <p>Keseluruhan Omset</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{ $usercount }}</h3>
            <p>User</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{ $transactioncount }}</h3>
            <p>Transaksi Selesai</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>{{ $productcount }}</h3>
            <p>Produk</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@stop
