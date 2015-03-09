<?php namespace App\Commands;

use App\Commands\Command;

use App\Http\Requests\TransactionRequest;
use Illuminate\Contracts\Bus\SelfHandling;

class updatePurchaseRecordCommand extends Command {
    /**
     * @var
     */
    public $id;
    /**
     * @var \App\Http\Requests\TransactionRequest
     */
    public $request;

    /**
     * Create a new command instance.
     *
     * @param                                       $id
     * @param \App\Http\Requests\TransactionRequest $request
     */
	public function __construct($id, TransactionRequest $request)
	{
        $this->id = $id;
        $this->request = $request;
    }

}
