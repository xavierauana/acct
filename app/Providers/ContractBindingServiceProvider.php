<?php namespace App\Providers;

use App\Contracts\Repositories\ItemInterface;
use App\Contracts\Repositories\TransactionInterface;
use App\Contracts\Repositories\VendorInterface;
use App\Transaction;
use App\Vendor;
use Illuminate\Support\ServiceProvider;

class ContractBindingServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
        $this->app->bind(TransactionInterface::class, Transaction::class);
        $this->app->bind(VendorInterface::class, Vendor::class);
        $this->app->bind(ItemInterface::class, Item::class);
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

}
