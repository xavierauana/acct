<?php namespace App;

use App\Contracts\Repositories\VendorInterface;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model implements VendorInterface {

    protected $fillable = [
        'name'
    ];

    /**
     * @param $name
     *
     * @return static /App/Contracts/Repositories/VendorInterface
     */
    public function findOrCreateVendorByName($name)
    {
        $result = $this->whereName($name)->first();
        if ($result)
        {
            return $result;
        }else{
            return $this->create(compact('name'));
        }
    }
}
