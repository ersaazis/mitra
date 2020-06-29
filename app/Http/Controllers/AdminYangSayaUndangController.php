<?php namespace App\Http\Controllers;

use ersaazis\cb\controllers\CBController;
use Illuminate\Support\Facades\DB;

class AdminYangSayaUndangController extends CBController {


    public function cbInit()
    {
        $this->setTable("users");
        $this->setPermalink("yang_saya_undang");
        $this->setPageTitle("Yang Saya Undang");

        $this->addText("Name","name")->strLimit(150)->maxLength(255);
        $this->addText("Informasi",'id')->indexDisplayTransform(function($id) {
            $bonus=DB::table('laporan_penjualan')->where('users_id',$id)->get([DB::raw('sum(jumlah)*10000 as bonus'),DB::raw('sum(jumlah) as jumlah')])->first();
            $return='Menjual : '.number_format($bonus->jumlah).' Produk <br>';
            $return.='Bonus Dari Afiliasi : Rp. '.number_format($bonus->bonus);
        return $return;
        });
        $this->hookIndexQuery(function ($query){
            $query->where('afiliate_id',cb()->session()->id());
            return $query;
        });
        $this->setBeforeIndexTable('
        <div id="box-filter" class="box box-default">
            <div class="box-body">
                <p>
                Informasi lebih lanjut hubungi admin.
                </p>
            </div>
        </div>
        ');
    }
}
