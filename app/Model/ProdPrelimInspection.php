<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\oqcVIR;
use App\User;

class ProdPrelimInspection extends Model
{
	protected $table = 'prelim_packing_inspections';
	protected $connection = "mysql";

	  public function oqcvir_details()
        {
            return $this->hasMany(oqcVIR::class, 'packing_code', 'pack_code_no');
        }

        public function user_details()
    	{
	    	return $this->hasOne(User::class, 'id', 'emp_id');
		}
}