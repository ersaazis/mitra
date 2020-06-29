<?php

namespace App\Http\Controllers;

use ersaazis\cb\controllers\CBController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends CBController
{
    public function getIndex(){
        $data['penjualan']=DB::table('laporan_penjualan')->where('users_id',cb()->session()->id())->get([DB::raw('sum(jumlah) as jumlah')])->first()->jumlah;
        $user=DB::table('users')->find(cb()->session()->id());
        $data['komisi']=$user->money;
        $data['rekening']=$user->rekening;
        $data['no_rekening']=$user->no_rekening;
        $afiliasi=DB::table('users')->where('afiliate_id',cb()->session()->id())->get();
        $data['afiliasi']=0;
        foreach ($afiliasi as $item) {
            $penjualan=DB::table('laporan_penjualan')->where('users_id',$item->id)->get([DB::raw('sum(jumlah) as jumlah')])->first()->jumlah;
            $data['afiliasi']+=$penjualan*10000;
        }
        $data['pageIcon'] = "fa fa-dashboard";
        $data['page_title'] = "Cara Mengupload Foto";
        return view("dashboard", $data);
    }
}
