<?php namespace App\Http\Controllers;

use ersaazis\cb\controllers\CBController;

class AdminMitraController extends CBController {


    public function cbInit()
    {
        $this->setTable("users");
        $this->setPermalink("mitra");
        $this->setPageTitle("Mitra");

        $this->addText("Name","name")->strLimit(150)->maxLength(255);
		$this->addEmail("Email","email");
		$this->addMoney("Money","money");
		$this->addText("Rekening","rekening")->strLimit(150)->maxLength(255);
		$this->addText("No Rekening","no_rekening")->strLimit(150)->maxLength(255);
		$this->addText("Kode Kupon","kode_kupon");
        $this->addSubModule("Bayar", AdminPembayaranAdminController::class, "users_id", function ($row) {
            // dd($row);
            return [
              "Nama Mitra"=> $row->name,
              "Email Mitra"=> $row->email,
              "Uang Aktif"=> $row->money,
              "Rekening"=> $row->rekening,
              "No Rekening"=> $row->no_rekening,
              "Kode Kupon"=> $row->kode_kupon,
            ];
        },function ($row){
            return true;
        }, "fa fa-money", 'success');


    }
}
