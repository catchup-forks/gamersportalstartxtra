<?php

namespace Modules\Games\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Genre;
use Amranidev\Ajaxis\Ajaxis;
use URL;

/**
 * Class GenreController.
 *
 * @author  The scaffold-interface created at 2016-12-25 05:32:02pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Index - genre';
        $genres = Genre::paginate(6);
        return view('genre.index',compact('genres','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create - genre';
        
        return view('genre.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $genre = new Genre();

        
        $genre->parentid = $request->parentid;

        
        $genre->genre = $request->genre;

        
        $genre->genreslug = $request->genreslug;

        
        $genre->gamespotid = $request->gamespotid;

        
        $genre->officialsite = $request->officialsite;

        
        $genre->lft = $request->lft;

        
        $genre->rgt = $request->rgt;

        
        $genre->depth = $request->depth;

        
        
        $genre->save();

        $pusher = App::make('pusher');

        //default pusher notification.
        //by default channel=test-channel,event=test-event
        //Here is a pusher notification example when you create a new resource in storage.
        //you can modify anything you want or use it wherever.
        $pusher->trigger('test-channel',
                         'test-event',
                        ['message' => 'A new genre has been created !!']);

        return redirect('genre');
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
        $title = 'Show - genre';

        if($request->ajax())
        {
            return URL::to('genre/'.$id);
        }

        $genre = Genre::findOrfail($id);
        return view('genre.show',compact('title','genre'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $title = 'Edit - genre';
        if($request->ajax())
        {
            return URL::to('genre/'. $id . '/edit');
        }

        
        $genre = Genre::findOrfail($id);
        return view('genre.edit',compact('title','genre'  ));
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
        $genre = Genre::findOrfail($id);
    	
        $genre->parentid = $request->parentid;
        
        $genre->genre = $request->genre;
        
        $genre->genreslug = $request->genreslug;
        
        $genre->gamespotid = $request->gamespotid;
        
        $genre->officialsite = $request->officialsite;
        
        $genre->lft = $request->lft;
        
        $genre->rgt = $request->rgt;
        
        $genre->depth = $request->depth;
        
        
        $genre->save();

        return redirect('genre');
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
        $msg = Ajaxis::BtDeleting('Warning!!','Would you like to remove This?','/genre/'. $id . '/delete');

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
     	$genre = Genre::findOrfail($id);
     	$genre->delete();
        return URL::to('genre');
    }
}
