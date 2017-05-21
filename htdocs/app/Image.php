<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'name', 'src'
    ];

    public function product()
    {
    	return $this->belongsTo(product::class);
    }
}
