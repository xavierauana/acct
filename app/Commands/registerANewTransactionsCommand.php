<?php namespace App\Commands;

use App\Commands\Command;

class registerANewTransactionsCommand extends Command {
    /**
     * @var array
     */
    public $data;

    /**
     * Create a new command instance.
     *
     * @param array $data
     */
	public function __construct(array $data)
	{
        $this->data = $data;
    }

}
