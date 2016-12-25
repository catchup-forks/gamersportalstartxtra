<?php

namespace Modules\GameNews\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Gamenews_feed;
use Amranidev\Ajaxis\Ajaxis;
use URL;

/**
 * Class Gamenews_feedController.
 *
 * @author  The scaffold-interface created at 2016-12-25 05:28:20pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Gamenews_feedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Index - gamenews_feed';
        $gamenews_feeds = Gamenews_feed::paginate(6);
        return view('gamenews_feed.index',compact('gamenews_feeds','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create - gamenews_feed';
        
        return view('gamenews_feed.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $gamenews_feed = new Gamenews_feed();

        
        $gamenews_feed->gamefeed_sourceid = $request->gamefeed_sourceid;

        
        $gamenews_feed->gamefeed_url = $request->gamefeed_url;

        
        $gamenews_feed->	gamefeed_sitename = $request->	gamefeed_sitename;

        
        $gamenews_feed->	gamefeed_siteslug = $request->	gamefeed_siteslug;

        
        
        $gamenews_feed->save();

        $pusher = App::make('pusher');

        //default pusher notification.
        //by default channel=test-channel,event=test-event
        //Here is a pusher notification example when you create a new resource in storage.
        //you can modify anything you want or use it wherever.
        $pusher->trigger('test-channel',
                         'test-event',
                        ['message' => 'A new gamenews_feed has been created !!']);

        return redirect('gamenews_feed');
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
        $title = 'Show - gamenews_feed';

        if($request->ajax())
        {
            return URL::to('gamenews_feed/'.$id);
        }

        $gamenews_feed = Gamenews_feed::findOrfail($id);
        return view('gamenews_feed.show',compact('title','gamenews_feed'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $title = 'Edit - gamenews_feed';
        if($request->ajax())
        {
            return URL::to('gamenews_feed/'. $id . '/edit');
        }

        
        $gamenews_feed = Gamenews_feed::findOrfail($id);
        return view('gamenews_feed.edit',compact('title','gamenews_feed'  ));
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
        $gamenews_feed = Gamenews_feed::findOrfail($id);
    	
        $gamenews_feed->gamefeed_sourceid = $request->gamefeed_sourceid;
        
        $gamenews_feed->gamefeed_url = $request->gamefeed_url;
        
        $gamenews_feed->	gamefeed_sitename = $request->	gamefeed_sitename;
        
        $gamenews_feed->	gamefeed_siteslug = $request->	gamefeed_siteslug;
        
        
        $gamenews_feed->save();

        return redirect('gamenews_feed');
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
        $msg = Ajaxis::BtDeleting('Warning!!','Would you like to remove This?','/gamenews_feed/'. $id . '/delete');

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
     	$gamenews_feed = Gamenews_feed::findOrfail($id);
     	$gamenews_feed->delete();
        return URL::to('gamenews_feed');
    }
}
