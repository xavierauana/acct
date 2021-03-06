<?php namespace App\Http\Controllers;

use App\Amount;
use App\Commands\deleteRecordCommand;
use App\Commands\getAllTransactionsCommand;
use App\Commands\getTheTransactionCommand;
use App\Commands\registerANewTransactionsCommand;
use App\Commands\updatePurchaseRecordCommand;
use App\Contracts\Repositories\TransactionInterface;
use App\Contracts\Repositories\VendorInterface;
use App\Entities\TransactionEntity;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\TransactionRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Jenssegers\Agent\Facades\Agent;

class TransactionsController extends Controller {
    /**
     * @var \App\Contracts\Repositories\TransactionInterface
     */
    private $transaction;

    function __construct(TransactionEntity $transaction)
    {
        $this->transaction = $transaction;
    }


    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $transactions = $this->dispatch(new getAllTransactionsCommand());
        return view('index', compact('transactions'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
    {
        $isDesktop = Agent::isDesktop();
		return view('create',compact('isDesktop'));
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\TransactionRequest $request
     *
     * @return \App\Http\Controllers\Response
     */
	public function store(TransactionRequest $request)
	{
        $this->dispatch(new registerANewTransactionsCommand($request));
        return redirect()->route('transactions.create');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $transaction = $this->dispatch(new getTheTransactionCommand($id));
		return view('edit', compact('transaction'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param  int                                  $id
     * @param \App\Http\Requests\TransactionRequest $request
     *
     * @return \Illuminate\Http\Response
     */
	public function update($id, TransactionRequest $request)
	{
        $this->dispatch(new updatePurchaseRecordCommand($id, $request));
        return redirect()->route('transactions.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->dispatch(new deleteRecordCommand($id));
        return redirect()->route('transactions.index');
	}

}
