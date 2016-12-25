<?php

namespace Modules\GameNews\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Gamenews;
use Amranidev\Ajaxis\Ajaxis;
use URL;

/**
 * Class GamenewsController.
 *
 * @author  The scaffold-interface created at 2016-12-25 05:09:47pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class GamenewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Index - gamenews';
        $gamenews = Gamenews::paginate(6);
        return view('gamenews.index',compact('gamenews','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create - gamenews';
        
        return view('gamenews.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $gamenews = new Gamenews();

        
        $gamenews->title = $request->title;

        
        $gamenews->slug = $request->slug;

        
        $gamenews->intro = $request->intro;

        
        $gamenews->body = $request->body;

        
        $gamenews->content_type = $request->content_type;

        
        $gamenews->source_id = $request->source_id;

        
        
        $gamenews->save();

        $pusher = App::make('pusher');

        //default pusher notification.
        //by default channel=test-channel,event=test-event
        //Here is a pusher notification example when you create a new resource in storage.
        //you can modify anything you want or use it wherever.
        $pusher->trigger('test-channel',
                         'test-event',
                        ['message' => 'A new gamenews has been created !!']);

        return redirect('gamenews');
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
        $title = 'Show - gamenews';

        if($request->ajax())
        {
            return URL::to('gamenews/'.$id);
        }

        $gamenews = Gamenews::findOrfail($id);
        return view('gamenews.show',compact('title','gamenews'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $title = 'Edit - gamenews';
        if($request->ajax())
        {
            return URL::to('gamenews/'. $id . '/edit');
        }

        
        $gamenews = Gamenews::findOrfail($id);
        return view('gamenews.edit',compact('title','gamenews'  ));
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
        $gamenews = Gamenews::findOrfail($id);
    	
        $gamenews->title = $request->title;
        
        $gamenews->slug = $request->slug;
        
        $gamenews->intro = $request->intro;
        
        $gamenews->body = $request->body;
        
        $gamenews->content_type = $request->content_type;
        
        $gamenews->source_id = $request->source_id;
        
        
        $gamenews->save();

        return redirect('gamenews');
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
        $msg = Ajaxis::BtDeleting('Warning!!','Would you like to remove This?','/gamenews/'. $id . '/delete');

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
     	$gamenews = Gamenews::findOrfail($id);
     	$gamenews->delete();
        return URL::to('gamenews');
    }
}
