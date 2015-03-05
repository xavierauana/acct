<?php
/**
 * Created by PhpStorm.
 * User: adrianexavier
 * Date: 5/3/15
 * Time: 11:53 AM
 */

namespace App\Contracts\Repositories;


use App\Amount;

interface TransactionInterface {

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function register(array $data);

    /**
     * @return mixed
     */
    public function allTransactions();
}