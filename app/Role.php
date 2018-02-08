<?php 

namespace App;
use Zizaco\Entrust\EntrustRole;


class Role extends EntrustRole
{
	public function clients() {
		return $this->hasMany('App\Client', 'role_id');
	}
}