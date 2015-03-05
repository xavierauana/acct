<?php namespace App;

use App\Contracts\Repositories\VendorInterface;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model implements VendorInterface {

    protected $fillable = [
        'name'
    ];
}
