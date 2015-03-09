<?php namespace App\Handlers\Commands;

use App\Commands\getTheTransactionCommand;

use App\Contracts\Repositories\TransactionInterface;
use Illuminate\Queue\InteractsWithQueue;

class getTheTransactionCommandHandler {
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
	 * @param  getTheTransactionCommand  $command
	 * @return \App\Contracts\Repositories\TransactionInterface
	 */
	public function handle(getTheTransactionCommand $command)
	{
        return $this->transaction->getById($command->id);
	}

}
