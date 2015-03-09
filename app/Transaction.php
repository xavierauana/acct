<?php namespace App;

use App\Contracts\Repositories\TransactionInterface;
use App\Contracts\Repositories\VendorInterface;
use App\Entities\VendorEntity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Transaction extends Model implements TransactionInterface{

    protected $fillable = [
        'amount',
        'vendor',
        'item',
        'payment',
        'receipt',
        'position',
    ];

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function register(array $data)
    {
        $this->create($data);
    }

    /**
     * @return mixed
     */
    public function allTransactions()
    {
        return $this->orderBy('created_at','desc')->get();
    }

    public function getPaymentAttribute($payment)
    {
        $paymentList = ['Cash', "Credit Card", "Octopus"];
        return $paymentList[$payment];
    }

    public function getVendorAttribute($vendorId)
    {
        return App::make(VendorInterface::class)->findOrFail($vendorId)->name;
    }
//
//    public function getAmountAttribute($amount)
//    {
//        return "$".number_format($amount, 1, '.', ',');
//    }


    /**
     * @param $id
     *
     * @return \App\Contracts\Repositories\TransactionInterface
     */
    public function getById($id)
    {
        return $this->findOrFail($id);
    }
}
