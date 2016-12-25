<?php

namespace Modules\Games\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Series;
use Amranidev\Ajaxis\Ajaxis;
use URL;

/**
 * Class SeriesController.
 *
 * @author  The scaffold-interface created at 2016-12-25 05:33:08pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class SeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Index - series';
        $series = Series::paginate(6);
        return view('series.index',compact('series','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create - series';
        
        return view('series.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $series = new Series();

        
        $series->series_name = $request->series_name;

        
        $series->series_slug = $request->series_slug;

        
        $series->officialsite = $request->officialsite;

        
        
        $series->save();

        $pusher = App::make('pusher');

        //default pusher notification.
        //by default channel=test-channel,event=test-event
        //Here is a pusher notification example when you create a new resource in storage.
        //you can modify anything you want or use it wherever.
        $pusher->trigger('test-channel',
                         'test-event',
                        ['message' => 'A new series has been created !!']);

        return redirect('series');
    }

    /**
     * Display the specified resource.
     *
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        $title = 'Show - series';

        if($request->ajax())
        {
            return URL::to('series/'.$id);
        }

        $series = Series::findOrfail($id);
        return view('series.show',compact('title','series'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $title = 'Edit - series';
        if($request->ajax())
        {
            return URL::to('series/'. $id . '/edit');
        }

        
        $series = Series::findOrfail($id);
        return view('series.edit',compact('title','series'  ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        $series = Series::findOrfail($id);
    	
        $series->series_name = $request->series_name;
        
        $series->series_slug = $request->series_slug;
        
        $series->officialsite = $request->officialsite;
        
        
        $series->save();

        return redirect('series');
    }

    /**
     * Delete confirmation message by Ajaxis.
     *
     * @link      https://github.com/amranidev/ajaxis
     * @param    \Illuminate\Http\Request  $request
     * @return  String
     */
    public function DeleteMsg($id,Request $request)
    {
        $msg = Ajaxis::BtDeleting('Warning!!','Would you like to remove This?','/series/'. $id . '/delete');

        if($request->ajax())
        {
            return $msg;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     	$series = Series::findOrfail($id);
     	$series->delete();
        return URL::to('series');
    }
}
