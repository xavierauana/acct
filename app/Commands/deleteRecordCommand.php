<?php namespace App\Commands;

use App\Commands\Command;

class deleteRecordCommand extends Command {
    /**
     * @var
     */
    public $id;

    /**
     * Create a new command instance.
     *
     * @param $id
     */
	public function __construct($id)
	{
		//
        $this->id = $id;
    }

}
