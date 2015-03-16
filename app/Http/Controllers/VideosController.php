<?php namespace App\Http\Controllers;

use App\Contracts\Repositories\VideoInterface;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\VideoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VideosController extends Controller {

    protected $video;

    function __construct(VideoInterface $video)
    {
        $this->video = $video;
    }


    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

        $videos = $this->video->all();;
		return view('videos.index',compact('videos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('videos.create');
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\VideoRequest $request
     *
     * @return \App\Http\Controllers\Response
     */
	public function store(Request $request)
	{
        Log::info($request->ajax());
        Log::info($request->user());
        Log::info($request->input('link'));
        $data = $request->has('link');

		return ['response'=>$data];
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
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
