<?php namespace App\Handlers\Commands;

use App\Commands\registerANewTransactionsCommand;

use App\Contracts\Repositories\TransactionInterface;
use App\Contracts\Repositories\VendorInterface;
use Illuminate\Contracts\Filesystem\Factory as Filesystem;
use Illuminate\Queue\InteractsWithQueue;
use Jenssegers\Agent\Facades\Agent;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
     * @var \Illuminate\Contracts\Filesystem\Filesystem
     */
    private $filesystem;

    /**
     * Create the command handler.
     *
     * @param \App\Contracts\Repositories\TransactionInterface $transaction
     * @param \App\Contracts\Repositories\VendorInterface      $vendor
     * @param \Illuminate\Contracts\Filesystem\Filesystem      $filesystem
     */
	public function __construct(TransactionInterface $transaction, VendorInterface $vendor, Filesystem $filesystem)
	{
        $this->transaction = $transaction;
        $this->vendor = $vendor;
        $this->filesystem = $filesystem;
    }

	/**
	 * Handle the command.
	 *
	 * @param  registerANewTransactionsCommand  $command
	 * @return void
	 */
	public function handle(registerANewTransactionsCommand $command)
	{
        $data = $command->request->all();
        if($command->request->hasFile('receipt')) $data['receipt'] = $this->uploadFile($command->request->file('receipt'),'receipts' );
        $vendor = $this->vendor->whereName($data['vendor'])->first();
        if(!$vendor) $vendor = $this->vendor->create(['name'=>$data['vendor']]);
        $data['vendor'] = $vendor->id;
		$this->transaction->register($data);
	}

    /**
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $file
     * @param                                                     $path
     *
     * @return string
     */
    private function uploadFile(UploadedFile $file, $path)
    {
        $filename  = uniqid((string)time(), true) . "." .$file->getClientOriginalExtension();
        $disk      = $this->filesystem->disk('local');
        $directory = storage_path() . "/app/$path";
        if ($disk->exists($directory)) $disk->makeDirectory($directory);
        $file->move($directory, $filename);
        return "/app/$path/".$filename;
    }
}