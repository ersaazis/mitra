@extends('crud::themes.adminlte.layout.layout')
@section('content')
<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-aqua-active"><i class="fa fa-shopping-bag"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Penjualan</span>
          <span class="info-box-number">{{$penjualan}} Produk</span>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green-active"><i class="fa fa-money"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Komisi Minggu ini</span>
          <span class="info-box-number">Rp. {{number_format($komisi)}}</span>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-yellow-active"><i class="fa fa-money"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Total Komisi</span>
          <span class="info-box-number">Rp. {{number_format(($penjualan*30000)+$afiliasi)}}</span>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-black"><i class="fa fa-money"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Komisi Dari Afiliasi</span>
          <span class="info-box-number">Rp. {{number_format($afiliasi)}}</span>
        </div>
      </div>
    </div>
  </div>
  <form action="<?php echo cb()->getAdminUrl('simpanrekening') ?>">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Informasi</h3>
        </div>
        <div class="box-body">
            <table class="table">
                <tr>
                    <th>Kode Kupon</th>
                    <td> : {{$rekening}}</td>
                </tr>
                <tr>
                    <th>Rekening</th>
                    <td> : {{$rekening}}</td>
                </tr>
                <tr>
                    <th>No Rekening</th>
                    <td> : {{$no_rekening}}</td>
                </tr>
                <tr>
                    <th>Atas Nama</th>
                    <td> : {{cb()->session()->name()}}</td>
                </tr>
            </table>
        </div>
    </div>
  </form>
@endsection