<?php

namespace cdi;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
	protected $table = 'vehicles';
    public function corporation(){
    	return $this->belongsTo(Corporation::class);
    }
    public function checks(){
        return $this->hasMany(Check::class);
    }
}
