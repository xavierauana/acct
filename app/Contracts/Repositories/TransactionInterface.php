<?php
/**
 * Created by PhpStorm.
 * User: adrianexavier
 * Date: 5/3/15
 * Time: 11:53 AM
 */

namespace App\Contracts\Repositories;


use App\Amount;

/**
 * Interface TransactionInterface
 *
 * @package App\Contracts\Repositories
 */
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

    /**
     * @param $id
     *
     * @return \App\Contracts\Repositories\TransactionInterface
     */
    public function getById($id);

    /**
     * @param       $id
     * @param array $data
     *
     * @return mixed
     */
    public function updateRecord($id, array $data);

    /**
     * @param $id
     *
     * @return mixed
     */
    public function deleteRecordById($id);
}