<?php namespace App\Http\Controllers;

use ersaazis\cb\controllers\CBController;

class AdminKontenController extends CBController {


    public function cbInit()
    {
        $this->setTable("konten");
        $this->setPermalink("konten");
        $this->setPageTitle("Konten");

        $this->addText("Foto1","foto1")->showAdd(false)->showEdit(false)->strLimit(150)->maxLength(255);
		$this->addText("Foto2","foto2")->showAdd(false)->showEdit(false)->strLimit(150)->maxLength(255);
		$this->addText("Foto3","foto3")->showAdd(false)->showEdit(false)->strLimit(150)->maxLength(255);
		$this->addText("Foto4","foto4")->showAdd(false)->showEdit(false)->strLimit(150)->maxLength(255);
		$this->addText("Foto5","foto5")->showAdd(false)->showEdit(false)->strLimit(150)->maxLength(255);
		$this->addText("Foto6","foto6")->showAdd(false)->showEdit(false)->strLimit(150)->maxLength(255);
		$this->addText("Title","title")->showAdd(false)->showEdit(false)->strLimit(150)->maxLength(255);
		$this->addText("Caption","caption")->showAdd(false)->showEdit(false)->strLimit(150)->maxLength(255);
		$this->addDatetime("Created At","created_at")->required(false)->showIndex(false)->showDetail(false)->showAdd(false)->showEdit(false);
		$this->addDatetime("Updated At","updated_at")->required(false)->showIndex(false)->showDetail(false)->showAdd(false)->showEdit(false);
		$this->addSelectOption("Jenis","jenis")->options(['Story'=>'Story','Post'=>'Post'])->filterable(true);
		

    }
}
