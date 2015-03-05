<?php
/**
 * Created by PhpStorm.
 * User: adrianexavier
 * Date: 5/3/15
 * Time: 2:59 PM
 */

namespace App\Entities;


use App\Contracts\Repositories\VendorInterface;

class VendorEntity extends AbstractEntity {

    public $repository;

    function __construct(VendorInterface $repository)
    {
        $this->repository = $repository;
    }

    public function check($name)
    {
        $vendor = $this->repository->whereName($name)->first();
        if(!$vendor)
        {
            $vendor =$this->create(compact('name'));
        }
        return $vendor->id;
    }


}