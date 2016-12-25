<?php

namespace Modules\GameLinks\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Gamelink;
use Amranidev\Ajaxis\Ajaxis;
use URL;

/**
 * Class GamelinkController.
 *
 * @author  The scaffold-interface created at 2016-12-25 05:10:43pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class GamelinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Index - gamelink';
        $gamelinks = Gamelink::paginate(6);
        return view('gamelink.index',compact('gamelinks','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create - gamelink';
        
        return view('gamelink.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $gamelink = new Gamelink();

        
        $gamelink->gamelinks_title = $request->gamelinks_title;

        
        $gamelink->httpcode = $request->httpcode;

        
        $gamelink->httpdefinition = $request->httpdefinition;

        
        $gamelink->is_checked = $request->is_checked;

        
        
        $gamelink->save();

        $pusher = App::make('pusher');

        //default pusher notification.
        //by default channel=test-channel,event=test-event
        //Here is a pusher notification example when you create a new resource in storage.
        //you can modify anything you want or use it wherever.
        $pusher->trigger('test-channel',
                         'test-event',
                        ['message' => 'A new gamelink has been created !!']);

        return redirect('gamelink');
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
        $title = 'Show - gamelink';

        if($request->ajax())
        {
            return URL::to('gamelink/'.$id);
        }

        $gamelink = Gamelink::findOrfail($id);
        return view('gamelink.show',compact('title','gamelink'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $title = 'Edit - gamelink';
        if($request->ajax())
        {
            return URL::to('gamelink/'. $id . '/edit');
        }

        
        $gamelink = Gamelink::findOrfail($id);
        return view('gamelink.edit',compact('title','gamelink'  ));
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
        $gamelink = Gamelink::findOrfail($id);
    	
        $gamelink->gamelinks_title = $request->gamelinks_title;
        
        $gamelink->httpcode = $request->httpcode;
        
        $gamelink->httpdefinition = $request->httpdefinition;
        
        $gamelink->is_checked = $request->is_checked;
        
        
        $gamelink->save();

        return redirect('gamelink');
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
        $msg = Ajaxis::BtDeleting('Warning!!','Would you like to remove This?','/gamelink/'. $id . '/delete');

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
     	$gamelink = Gamelink::findOrfail($id);
     	$gamelink->delete();
        return URL::to('gamelink');
    }
}
