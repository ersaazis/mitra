<?php namespace App\Http\Controllers;

use ersaazis\cb\controllers\CBController;

class AdminLaporanPenjualanController extends CBController {


    public function cbInit()
    {
        $this->setTable("laporan_penjualan");
        $this->setPermalink("laporan_penjualan");
        $this->setPageTitle("Laporan Penjualan");

        $this->addText("Tanggal Bayar","tanggal_bayar")->showAdd(false)->showEdit(false)->strLimit(150)->maxLength(255);
		$this->addText("Metode Pembayaran","metode_pembayaran")->showAdd(false)->showEdit(false)->strLimit(150)->maxLength(255);
		$this->addText("Produk Dipesan","produk_dipesan")->showAdd(false)->showEdit(false)->strLimit(150)->maxLength(255);
		$this->addText("Jumlah","jumlah")->showAdd(false)->showEdit(false)->strLimit(150)->maxLength(255);
		$this->addText("Nama Pembeli","nama_pembeli")->showAdd(false)->showEdit(false)->strLimit(150)->maxLength(255);
		$this->addText("Kode Diskon","kode_diskon")->showAdd(false)->showEdit(false)->strLimit(150)->maxLength(255);
        
        $this->hookIndexQuery(function ($query){
            $query->where('users_id',cb()->session()->id());
            return $query;
        });

        $this->setBeforeIndexTable('
        <div id="box-filter" class="box box-default">
            <div class="box-header with-border">
                <small>Mohon maaf kami hanya dapat menampilkan sebagian informasi dari pembeli, karena menyangkut privasi </small>
            </div>
        </div>
        ');
    }
}
