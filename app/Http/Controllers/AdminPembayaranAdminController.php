<?php namespace App\Http\Controllers;

use ersaazis\cb\controllers\CBController;
use Illuminate\Support\Facades\DB;

class AdminPembayaranAdminController extends CBController {


    public function cbInit()
    {
        $this->setTable("pembayaran");
        $this->setPermalink("pembayaran_admin");
        $this->setPageTitle("Pembayaran Admin");

        $this->addSelectTable("User","users_id",["table"=>"users","value_option"=>"id","display_option"=>"name","sql_condition"=>""]);
		$this->addText("Rekening","rekening")->filterable(true)->strLimit(150)->maxLength(255);
		$this->addText("No Rekening","no_rekening")->filterable(true)->strLimit(150)->maxLength(255);
		$this->addText("Atas Nama","atas_nama")->filterable(true)->strLimit(150)->maxLength(255);
		$this->addImage("Bukti Transfer","bukti_tf")->encrypt(true);
		$this->addMoney("Nominal","nominal")->prefix('Rp')->thousandSeparator('.')->decimalSeparator(',');
		$this->addDatetime("Created At","created_at")->required(false)->showAdd(false)->showEdit(false);
        
        $this->hookBeforeInsert(function($data) {
            $user=DB::table('users')->find($data['users_id']);
			$money=$user->money;
			DB::table('users')->where('id',$data['users_id'])->update([
				'money' =>  ($money-$data['nominal'])
			]);
			return $data;
        });
		$this->hookBeforeUpdate(function($data, $id) {
			$pembayaran=DB::table('pembayaran')->find($id);
            $user=DB::table('users')->find($pembayaran->users_id);
            $money=$user->money;
			DB::table('users')->where('id',$pembayaran->users_id)->update([
				'money' =>  ($money+$pembayaran->nominal)-$data['nominal']
			]);
            return $data;
        });    
    }
    public function getDelete($id)
    {
        if(!module()->canDelete()) return cb()->redirect(cb()->getAdminUrl(),cbLang("you_dont_have_privilege_to_this_area"));
        
        $pembayaran=DB::table('pembayaran')->find($id);
        $user=DB::table('users')->find($pembayaran->users_id);
        $money=$user->money;
        DB::table('users')->where('id',$pembayaran->users_id)->update([
            'money' =>  ($money+$pembayaran->nominal)
        ]);

        $softDelete = false;
        if ($softDelete === true && Schema::hasColumn('pembayaran','deleted_at')) {
            DB::table('pembayaran')
                ->where(getPrimaryKey('pembayaran'), $id)
                ->update(['deleted_at' => date('Y-m-d H:i:s')]);
        } else {
            DB::table('pembayaran')
                ->where(getPrimaryKey('pembayaran'), $id)
                ->delete();
        }
        return cb()->redirectBack( cbLang("the_data_has_been_deleted"), 'success');
    }

}
