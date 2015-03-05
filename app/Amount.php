<?php
/**
 * Created by PhpStorm.
 * User: adrianexavier
 * Date: 5/3/15
 * Time: 12:17 PM
 */

namespace App;


class Amount {


    private $amount;

    function __construct($amount)
    {
        $amount = (float) $amount;
        $this->disallowInvalidAmount($amount);
        $this->amount = $amount;
    }

    private function disallowInvalidAmount($amount)
    {
         if($amount < 0)
         {
             new \InvalidArgumentException('Cannot smaller than 0');
         }
    }

    function __invoke()
    {
        return $this->amount;
    }


}