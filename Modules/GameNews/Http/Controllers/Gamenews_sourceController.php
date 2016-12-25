<?php

namespace Modules\GameNews\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Gamenews_source;
use Amranidev\Ajaxis\Ajaxis;
use URL;

/**
 * Class Gamenews_sourceController.
 *
 * @author  The scaffold-interface created at 2016-12-25 05:11:56pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Gamenews_sourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Index - gamenews_source';
        $gamenews_sources = Gamenews_source::paginate(6);
        return view('gamenews_source.index',compact('gamenews_sources','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create - gamenews_source';
        
        return view('gamenews_source.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $gamenews_source = new Gamenews_source();

        
        $gamenews_source->source_name = $request->source_name;

        
        
        $gamenews_source->save();

        $pusher = App::make('pusher');

        //default pusher notification.
        //by default channel=test-channel,event=test-event
        //Here is a pusher notification example when you create a new resource in storage.
        //you can modify anything you want or use it wherever.
        $pusher->trigger('test-channel',
                         'test-event',
                        ['message' => 'A new gamenews_source has been created !!']);

        return redirect('gamenews_source');
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
        $title = 'Show - gamenews_source';

        if($request->ajax())
        {
            return URL::to('gamenews_source/'.$id);
        }

        $gamenews_source = Gamenews_source::findOrfail($id);
        return view('gamenews_source.show',compact('title','gamenews_source'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $title = 'Edit - gamenews_source';
        if($request->ajax())
        {
            return URL::to('gamenews_source/'. $id . '/edit');
        }

        
        $gamenews_source = Gamenews_source::findOrfail($id);
        return view('gamenews_source.edit',compact('title','gamenews_source'  ));
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
        $gamenews_source = Gamenews_source::findOrfail($id);
    	
        $gamenews_source->source_name = $request->source_name;
        
        
        $gamenews_source->save();

        return redirect('gamenews_source');
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
        $msg = Ajaxis::BtDeleting('Warning!!','Would you like to remove This?','/gamenews_source/'. $id . '/delete');

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
     	$gamenews_source = Gamenews_source::findOrfail($id);
     	$gamenews_source->delete();
        return URL::to('gamenews_source');
    }
}
