<?php namespace App\Providers;

use App\Contracts\Repositories\ItemInterface;
use App\Contracts\Repositories\TransactionInterface;
use App\Contracts\Repositories\VendorInterface;
use App\Contracts\Repositories\VideoInterface;
use App\Transaction;
use App\Vendor;
use App\Video;
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
        $this->app->bind(VideoInterface::class, Video::class);
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
