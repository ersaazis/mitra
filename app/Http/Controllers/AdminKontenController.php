<?php namespace App\Http\Controllers;

use ersaazis\cb\controllers\CBController;

class AdminKontenController extends CBController {


    public function cbInit()
    {
        $this->setTable("konten");
        $this->setPermalink("konten");
        $this->setPageTitle("Konten");

        $this->addFile("Foto1","foto1")->showAdd(false)->showEdit(false)->indexDisplayTransform(function($row) {
			$file=$row->row->foto1;
			$mime=(!empty($file)?mime_content_type($file):null);
			if($mime) {
				$return='<center>';
				if(strpos($mime,'video') !== false){
					$return.='
					<video width="200" height="200" controls>
					<source src="'.url($file).'" type="video/mp4">
					Your browser does not support the video tag.
					</video>
					';
				}
				else if(strpos($mime,'image') !== false){
					$return.='<img src="'.url($file).'" width="200px" />';
				}
				$return.="<br />";
				$return.='<a href ="'.url($file).'" class="btn btn-primary" target="_blank">Download Slide 1</a>';
				$return.="<br /><br />";
			}

			$file=$row->row->foto2;
			$mime=(!empty($file)?mime_content_type($file):null);
			if($mime) {
				if(strpos($mime,'video') !== false){
					$return.='
					<video width="200" height="200" controls>
					<source src="'.url($file).'" type="video/mp4">
					Your browser does not support the video tag.
					</video>
					';
				}
				else if(strpos($mime,'image') !== false){
					$return.='<img src="'.url($file).'" width="200px" />';
				}
				$return.="<br />";
				$return.='<a href ="'.url($file).'" class="btn btn-primary" target="_blank">Download Slide 2</a>';
				$return.="<br /><br />";
			}

			$file=$row->row->foto3;
			$mime=(!empty($file)?mime_content_type($file):null);
			if($mime) {
				if(strpos($mime,'video') !== false){
					$return.='
					<video width="200" height="200" controls>
					<source src="'.url($file).'" type="video/mp4">
					Your browser does not support the video tag.
					</video>
					';
				}
				else if(strpos($mime,'image') !== false){
					$return.='<img src="'.url($file).'" width="200px" />';
				}
				$return.="<br />";
				$return.='<a href ="'.url($file).'" class="btn btn-primary" target="_blank">Download Slide 3</a>';
				$return.="<br /><br />";
			}

			$file=$row->row->foto4;
			$mime=(!empty($file)?mime_content_type($file):null);
			if($mime) {
				if(strpos($mime,'video') !== false){
					$return.='
					<video width="200" height="200" controls>
					<source src="'.url($file).'" type="video/mp4">
					Your browser does not support the video tag.
					</video>
					';
				}
				else if(strpos($mime,'image') !== false){
					$return.='<img src="'.url($file).'" width="200px" />';
				}
				$return.="<br />";
				$return.='<a href ="'.url($file).'" class="btn btn-primary" target="_blank">Download Slide 4</a>';
				$return.="<br /><br />";
			}

			$file=$row->row->foto5;
			$mime=(!empty($file)?mime_content_type($file):null);
			if($mime) {
				if(strpos($mime,'video') !== false){
					$return.='
					<video width="200" height="200" controls>
					<source src="'.url($file).'" type="video/mp4">
					Your browser does not support the video tag.
					</video>
					';
				}
				else if(strpos($mime,'image') !== false){
					$return.='<img src="'.url($file).'" width="200px" />';
				}
				$return.="<br />";
				$return.='<a href ="'.url($file).'" class="btn btn-primary" target="_blank">Download Slide 5</a>';
				$return.="<br /><br />";
			}

			$file=$row->row->foto6;
			$mime=(!empty($file)?mime_content_type($file):null);
			if($mime) {
				if(strpos($mime,'video') !== false){
					$return.='
					<video width="200" height="200" controls>
					<source src="'.url($file).'" type="video/mp4">
					Your browser does not support the video tag.
					</video>
					';
				}
				else if(strpos($mime,'image') !== false){
					$return.='<img src="'.url($file).'" width="200px" />';
				}
				$return.="<br />";
				$return.='<a href ="'.url($file).'" class="btn btn-primary" target="_blank">Download Slide 6</a>';
				$return.="<br /><br />";
			}
				$return.="</center>";

			return $return;
		});
		$this->addFile("Foto2","foto2")->showAdd(false)->showEdit(false)->showIndex(false);
		$this->addFile("Foto3","foto3")->showAdd(false)->showEdit(false)->showIndex(false);
		$this->addFile("Foto4","foto4")->showAdd(false)->showEdit(false)->showIndex(false);
		$this->addFile("Foto5","foto5")->showAdd(false)->showEdit(false)->showIndex(false);
		$this->addFile("Foto6","foto6")->showAdd(false)->showEdit(false)->showIndex(false);
		$this->addText("Title","title")->showAdd(false)->showEdit(false)->strLimit(150)->maxLength(255);
		$this->addText("Caption","caption")->showAdd(false)->showEdit(false)->strLimit(150)->maxLength(255);
		$this->addDatetime("Created At","created_at")->required(false)->showIndex(false)->showDetail(false)->showAdd(false)->showEdit(false);
		$this->addDatetime("Updated At","updated_at")->required(false)->showIndex(false)->showDetail(false)->showAdd(false)->showEdit(false);
		$this->addSelectOption("Jenis","jenis")->options(['Story'=>'Story','Post'=>'Post'])->filterable(true);
		

    }
}
