<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;

class ProdRuncardAccessory extends Model
{
    //
    protected $table = 'prod_runcard_accessories';

    public function counted_by_info()
	{
    	return $this->hasOne(User::class, 'id', 'counted_by');
	}

	public function checked_by_info()
	{
    	return $this->hasOne(User::class, 'id', 'checked_by');
	}

	public function prod_supervisor_info()
	{
    	return $this->hasOne(User::class, 'id', 'prod_supervisor');
	}
}
