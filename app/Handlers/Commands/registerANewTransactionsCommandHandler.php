<?php namespace App\Handlers\Commands;

use App\Commands\registerANewTransactionsCommand;

use App\Contracts\Repositories\TransactionInterface;
use App\Contracts\Repositories\VendorInterface;
use Illuminate\Queue\InteractsWithQueue;

class registerANewTransactionsCommandHandler {
    /**
     * @var \App\Contracts\Repositories\TransactionInterface
     */
    private $transaction;
    /**
     * @var \App\Contracts\Repositories\VendorInterface
     */
    private $vendor;

    /**
     * Create the command handler.
     *
     * @param \App\Contracts\Repositories\TransactionInterface $transaction
     * @param \App\Contracts\Repositories\VendorInterface      $vendor
     */
	public function __construct(TransactionInterface $transaction, VendorInterface $vendor)
	{
        $this->transaction = $transaction;
        $this->vendor = $vendor;
    }

	/**
	 * Handle the command.
	 *
	 * @param  registerANewTransactionsCommand  $command
	 * @return void
	 */
	public function handle(registerANewTransactionsCommand $command)
	{
        $vendor = $this->vendor->whereName($command->data['vendor'])->first();
        if(!$vendor)
        {
            $data = ['name' => $command->data['vendor']];
            $vendor =$this->vendor->create($data);
        }
        $command->data['vendor'] = $vendor->id;
		$this->transaction->create($command->data);
	}
}
