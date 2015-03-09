<?php
/**
 * Created by PhpStorm.
 * User: adrianexavier
 * Date: 5/3/15
 * Time: 12:40 PM
 */

namespace App\Contracts\Repositories;


interface VendorInterface {

    /**
     * @param $name
     *
     * @return /App/Contracts/Repositories/VendorInterface
     */
    public function findOrCreateVendorByName($name);
}