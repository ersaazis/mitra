@extends('crud::themes.adminlte.layout.layout')
@section('content')
<form action="<?php echo cb()->getAdminUrl('import/data/penjualan') ?>" method="POST">
  @csrf
  <div class="box">
      <div class="box-header with-border">
          <h3 class="box-title">Import Data Pembelian</h3>
      </div>
      <div class="box-body">
        <form action="<?php echo cb()->getAdminUrl('/import/data/penjualan') ?>" method="POST">
          <textarea name="data" id="" class="form-control" rows="10"></textarea>
          <br>
          <input type="submit" class="btn btn-default" value="Import">
        </form>
      </div>
  </div>
</form>
@endsection