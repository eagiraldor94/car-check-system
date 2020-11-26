<?php

namespace cdi;

use Illuminate\Database\Eloquent\Model;

class Check extends Model
{
	protected $table = 'checks';
    public function vehicle(){
    	return $this->belongsTo(Vehicle::class);
    }
    public function corporation(){
    	return $this->belongsTo(Corporation::class);
    }
}
