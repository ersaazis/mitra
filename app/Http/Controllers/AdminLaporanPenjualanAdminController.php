<?php namespace App\Http\Controllers;

use DateTime;
use ersaazis\cb\controllers\CBController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AdminLaporanPenjualanAdminController extends CBController {


    public function cbInit()
    {
        $this->setTable("laporan_penjualan");
        $this->setPermalink("laporan_penjualan_admin");
        $this->setPageTitle("Laporan Penjualan Admin");

        $this->addSelectTable("User","users_id",["table"=>"users","value_option"=>"id","display_option"=>"name","sql_condition"=>""])->filterable(true);
		$this->addText("Tanggal Bayar","tanggal_bayar")->placeholder('Y-M-D H:m:s')->filterable(true);
		$this->addText("Metode Pembayaran","metode_pembayaran")->strLimit(150)->maxLength(255);
		$this->addText("Produk Dipesan","produk_dipesan")->strLimit(150)->maxLength(255);
		$this->addNumber("Jumlah","jumlah");
		$this->addText("Nama Pembeli","nama_pembeli")->strLimit(150)->maxLength(255);
		$this->addText("Kode Diskon","kode_diskon")->filterable(true)->strLimit(150)->maxLength(255);
		$this->addDatetime("Created At","created_at")->required(false)->showDetail(false)->showAdd(false)->showEdit(false);
		$this->addDatetime("Updated At","updated_at")->required(false)->showDetail(false)->showAdd(false)->showEdit(false);
		
		$this->addIndexActionButton("Import",cb()->getAdminUrl('/import/data/penjualan'),'fa fa-upload','primary');
		$this->hookBeforeInsert(function($data) {
			$user=DB::table('users')->find($data['users_id']);
			$money=$user->money;
			$fee=$data['jumlah']*30000;
			DB::table('users')->where('id',$data['users_id'])->update([
				'money' =>  ($money+$fee)
			]);
			if($user->afiliate_id){
				$user2=DB::table('users')->find($user->afiliate_id);
				$money2=$user2->money;
				$fee2=$data['jumlah']*10000;
				DB::table('users')->where('id',$user->afiliate_id)->update([
					'money' =>  ($money2+$fee2)
				]);
			}
			return $data;
        });
		$this->hookBeforeUpdate(function($data, $id) {
			$user=DB::table('users')->find($data['users_id']);
			$laporan_penjualan=DB::table('laporan_penjualan')->find($id);
			$money=$user->money;
			$fee_before=$laporan_penjualan->jumlah*30000;
			$fee=$data['jumlah']*30000;
			DB::table('users')->where('id',$data['users_id'])->update([
				'money' =>  (($money-$fee_before)+$fee)
			]);
			if($user->afiliate_id){
				$user2=DB::table('users')->find($user->afiliate_id);
				$money2=$user2->money;
				$fee_before2=$laporan_penjualan->jumlah*10000;
				$fee2=$data['jumlah']*10000;
				DB::table('users')->where('id',$user->afiliate_id)->update([
					'money' =>  (($money2-$fee_before2)+$fee2)
				]);
			}
            return $data;
        });
	}
	public function getDelete($id)
    {
        if(!module()->canDelete()) return cb()->redirect(cb()->getAdminUrl(),cbLang("you_dont_have_privilege_to_this_area"));
		
		$laporan_penjualan=DB::table('laporan_penjualan')->find($id);
		$user=DB::table('users')->find($laporan_penjualan->users_id);
		$money=$user->money;
		$fee_before=$laporan_penjualan->jumlah*30000;
		DB::table('users')->where('id',$laporan_penjualan->users_id)->update([
			'money' =>  ($money-$fee_before)
		]);
		if($user->afiliate_id){
			$user2=DB::table('users')->find($user->afiliate_id);
			$money2=$user2->money;
			$fee_before2=$laporan_penjualan->jumlah*10000;
			DB::table('users')->where('id',$user->afiliate_id)->update([
				'money' =>  ($money2-$fee_before2)
			]);
		}
		// exit();

        $softDelete = false;
        if ($softDelete === true && Schema::hasColumn('laporan_penjualan','deleted_at')) {
            DB::table('laporan_penjualan')
                ->where(getPrimaryKey('laporan_penjualan'), $id)
                ->update(['deleted_at' => date('Y-m-d H:i:s')]);
        } else {
            DB::table('laporan_penjualan')
                ->where(getPrimaryKey('laporan_penjualan'), $id)
                ->delete();
        }
        return cb()->redirectBack( cbLang("the_data_has_been_deleted"), 'success');
	}
	public function import(){
		$data['pageIcon'] = "fa fa-upload";
        $data['page_title'] = "Import Data Pembelian";
        return view("import", $data);
	}
	public function importSave(Request $request){
		$data=$request->all()['data'];
		$data=explode("\n",$data);
		foreach($data as $item){
			$data=explode(',',$item);
			$cek=DB::table('laporan_penjualan')->find((int) $data[1]);
			if(!$cek){
				$user=DB::table('users')->where('kode_kupon',$data[21])->first();
				if($user && $data[4] !=''){
					// dd($user);
					$money=$user->money;
					$fee=$data[12]*30000;
					DB::table('users')->where('kode_kupon',$data[21])->update([
						'money' =>  ($money+$fee)
					]);
					if($user->afiliate_id){
						$user2=DB::table('users')->find($user->afiliate_id);
						$money2=$user2->money;
						$fee2=$data[12]*10000;
						DB::table('users')->where('id',$user->afiliate_id)->update([
							'money' =>  ($money2+$fee2)
						]);
					}

					$insert=array(
						'id'=>(int) $data[1],
						'tanggal_bayar'=>DateTime::createFromFormat('d/m/Y h:i', $data[4]),
						'users_id'=>$user->id,
						'metode_pembayaran'=>$data[30],
						'produk_dipesan'=>$data[6],
						'jumlah'=>$data[12],
						'nama_pembeli'=>$data[13],
						'kode_diskon'=>$data[21],
					);
					$cek=DB::table('laporan_penjualan')->insert($insert);
				}
			}
		}
        return cb()->redirectBack( 'Berhasil Di Import', 'success');
	}
}
