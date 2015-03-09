<?php namespace App\Handlers\Commands;

use App\Commands\deleteRecordCommand;

use App\Contracts\Repositories\TransactionInterface;
use Illuminate\Queue\InteractsWithQueue;

class deleteRecordCommandHandler {
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
	 * @param  deleteRecordCommand  $command
	 * @return void
	 */
	public function handle(deleteRecordCommand $command)
	{
		$this->transaction->deleteRecordById($command->id);
	}

}
