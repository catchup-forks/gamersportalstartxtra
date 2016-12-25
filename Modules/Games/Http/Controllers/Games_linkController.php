<?php

namespace Modules\Games\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Games_link;
use Amranidev\Ajaxis\Ajaxis;
use URL;

/**
 * Class Games_linkController.
 *
 * @author  The scaffold-interface created at 2016-12-25 05:14:05pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Games_linkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Index - games_link';
        $games_links = Games_link::paginate(6);
        return view('games_link.index',compact('games_links','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create - games_link';
        
        return view('games_link.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $games_link = new Games_link();

        
        $games_link->gamepageurl = $request->gamepageurl;

        
        $games_link->downloadurl = $request->downloadurl;

        
        $games_link->downloadurl2 = $request->downloadurl2;

        
        $games_link->downloadurl3 = $request->downloadurl3;

        
        $games_link->downloadurl4 = $request->downloadurl4;

        
        
        $games_link->save();

        $pusher = App::make('pusher');

        //default pusher notification.
        //by default channel=test-channel,event=test-event
        //Here is a pusher notification example when you create a new resource in storage.
        //you can modify anything you want or use it wherever.
        $pusher->trigger('test-channel',
                         'test-event',
                        ['message' => 'A new games_link has been created !!']);

        return redirect('games_link');
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
        $title = 'Show - games_link';

        if($request->ajax())
        {
            return URL::to('games_link/'.$id);
        }

        $games_link = Games_link::findOrfail($id);
        return view('games_link.show',compact('title','games_link'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $title = 'Edit - games_link';
        if($request->ajax())
        {
            return URL::to('games_link/'. $id . '/edit');
        }

        
        $games_link = Games_link::findOrfail($id);
        return view('games_link.edit',compact('title','games_link'  ));
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
        $games_link = Games_link::findOrfail($id);
    	
        $games_link->gamepageurl = $request->gamepageurl;
        
        $games_link->downloadurl = $request->downloadurl;
        
        $games_link->downloadurl2 = $request->downloadurl2;
        
        $games_link->downloadurl3 = $request->downloadurl3;
        
        $games_link->downloadurl4 = $request->downloadurl4;
        
        
        $games_link->save();

        return redirect('games_link');
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
        $msg = Ajaxis::BtDeleting('Warning!!','Would you like to remove This?','/games_link/'. $id . '/delete');

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
     	$games_link = Games_link::findOrfail($id);
     	$games_link->delete();
        return URL::to('games_link');
    }
}
