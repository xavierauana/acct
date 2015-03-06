<?php namespace App\Commands;

use App\Commands\Command;
use App\Http\Requests\TransactionRequest;

class registerANewTransactionsCommand extends Command {

    /**
     * @var \App\Http\Requests\TransactionRequest
     */
    public $request;

    /**
     * Create a new command instance.
     *
     * @param \App\Http\Requests\TransactionRequest $request
     *
     */
	public function __construct(TransactionRequest $request)
	{
        $this->request = $request;
    }

}
