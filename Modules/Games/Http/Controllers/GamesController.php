<?php

namespace Modules\Games\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Game;
use Amranidev\Ajaxis\Ajaxis;
use URL;

/**
 * Class GameController.
 *
 * @author  The scaffold-interface created at 2016-12-25 05:08:37pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Index - game';
        $games = Game::paginate(6);
        return view('game.index',compact('games','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create - game';
        
        return view('game.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $game = new Game();

        
        $game->gamename = $request->gamename;

        
        $game->slug = $request->slug;

        
        
        $game->save();

        $pusher = App::make('pusher');

        //default pusher notification.
        //by default channel=test-channel,event=test-event
        //Here is a pusher notification example when you create a new resource in storage.
        //you can modify anything you want or use it wherever.
        $pusher->trigger('test-channel',
                         'test-event',
                        ['message' => 'A new game has been created !!']);

        return redirect('game');
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
        $title = 'Show - game';

        if($request->ajax())
        {
            return URL::to('game/'.$id);
        }

        $game = Game::findOrfail($id);
        return view('game.show',compact('title','game'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $title = 'Edit - game';
        if($request->ajax())
        {
            return URL::to('game/'. $id . '/edit');
        }

        
        $game = Game::findOrfail($id);
        return view('game.edit',compact('title','game'  ));
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
        $game = Game::findOrfail($id);
    	
        $game->gamename = $request->gamename;
        
        $game->slug = $request->slug;
        
        
        $game->save();

        return redirect('game');
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
        $msg = Ajaxis::BtDeleting('Warning!!','Would you like to remove This?','/game/'. $id . '/delete');

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
     	$game = Game::findOrfail($id);
     	$game->delete();
        return URL::to('game');
    }
}
