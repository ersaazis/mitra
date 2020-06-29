<?php namespace App\Http\Controllers;

use ersaazis\cb\controllers\CBController;

class AdminPembayaranController extends CBController {


    public function cbInit()
    {
        $this->setTable("pembayaran");
        $this->setPermalink("pembayaran");
        $this->setPageTitle("Pembayaran");

        $this->addText("Rekening","rekening")->showAdd(false)->showEdit(false)->strLimit(150)->maxLength(255);
		$this->addText("No Rekening","no_rekening")->showAdd(false)->showEdit(false)->strLimit(150)->maxLength(255);
		$this->addText("Atas Nama","atas_nama")->showAdd(false)->showEdit(false)->strLimit(150)->maxLength(255);
		$this->addText("Bukti Transfer","bukti_tf")->showAdd(false)->showEdit(false)->strLimit(150)->maxLength(255);
		$this->addMoney("Nominal","nominal")->showAdd(false)->showEdit(false)->prefix('Rp')->thousandSeparator('.')->decimalSeparator(',');
		$this->addDatetime("Tanggal","created_at")->required(false)->showAdd(false)->showEdit(false);
		

    }
}
