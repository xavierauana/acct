<?php
/**
 * Created by PhpStorm.
 * User: adrianexavier
 * Date: 5/3/15
 * Time: 2:43 PM
 */

namespace App\Entities;


use App\Contracts\Repositories\TransactionInterface;

class TransactionEntity extends AbstractEntity {

    public $repository;
    /**
     * @var
     */
    private $vendor;

    /**
     * @param \App\Contracts\Repositories\TransactionInterface $repository
     * @param \App\Entities\VendorEntity                       $vendor
     */
    function __construct(TransactionInterface $repository, VendorEntity $vendor)
    {
        $this->repository = $repository;
        $this->vendor = $vendor;
    }

    public function register($data)
    {
        $data['vendor'] = $this->vendor->check($data['vendor']);
        return $this->repository->create($data);
    }

}