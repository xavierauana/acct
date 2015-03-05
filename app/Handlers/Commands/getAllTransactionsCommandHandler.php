<?php namespace App\Handlers\Commands;

use App\Commands\getAllTransactionsCommand;

use App\Contracts\Repositories\TransactionInterface;
use Illuminate\Queue\InteractsWithQueue;

class getAllTransactionsCommandHandler {
    /**
     * @var \App\Contracts\Repositories\TransactionInterface
     */
    private $transaction;

    /**
     * Create the command handler.
     *
     * @param \App\Contracts\Repositories\TransactionInterface $transaction
     */
	public function __construct(TransactionInterface $transaction)
	{
        $this->transaction = $transaction;
    }

	/**
	 * Handle the command.
	 *
	 * @param  getAllTransactionsCommand  $command
	 * @return \Illuminate\Support\Collection
	 */
	public function handle(getAllTransactionsCommand $command)
	{
        $transactions = $this->transaction->orderBy('created_at','desc')->get();
		return $transactions;
	}

}
