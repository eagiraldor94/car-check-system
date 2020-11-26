<?php

namespace cdi;

use Illuminate\Database\Eloquent\Model;

class Corporation extends Model
{
	protected $table = 'corporations';
    public function vehicles(){
        return $this->hasMany(Vehicle::class);
    }
    public function checks(){
        return $this->hasMany(Check::class);
    }
}
