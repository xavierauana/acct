<?php namespace App\Handlers\Commands;

use App\Commands\updatePurchaseRecordCommand;

use App\Contracts\Repositories\TransactionInterface;
use App\Contracts\Repositories\VendorInterface;
use Illuminate\Queue\InteractsWithQueue;

class updatePurchaseRecordCommandHandler {
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
	 * @param  updatePurchaseRecordCommand  $command
	 * @return void
	 */
	public function handle(updatePurchaseRecordCommand $command)
	{

        $data = $command->request->all();
        $data['vendor'] = $this->vendor->findOrCreateVendorByName($command->request->get('vendor'))->id;
        $id = $command->id;
        $this->transaction->updateRecord($id, $data);
	}

}
