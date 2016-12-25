<?php

namespace Modules\DevPub\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Devpub;
use Amranidev\Ajaxis\Ajaxis;
use URL;

/**
 * Class DevpubController.
 *
 * @author  The scaffold-interface created at 2016-12-25 05:12:53pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class DevpubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Index - devpub';
        $devpubs = Devpub::paginate(6);
        return view('devpub.index',compact('devpubs','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create - devpub';
        
        return view('devpub.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $devpub = new Devpub();

        
        $devpub->devpubname = $request->devpubname;

        
        $devpub->devpubslug = $request->devpubslug;

        
        $devpub->devpubtype = $request->devpubtype;

        
        $devpub->is_great = $request->is_great;

        
        
        $devpub->save();

        $pusher = App::make('pusher');

        //default pusher notification.
        //by default channel=test-channel,event=test-event
        //Here is a pusher notification example when you create a new resource in storage.
        //you can modify anything you want or use it wherever.
        $pusher->trigger('test-channel',
                         'test-event',
                        ['message' => 'A new devpub has been created !!']);

        return redirect('devpub');
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
        $title = 'Show - devpub';

        if($request->ajax())
        {
            return URL::to('devpub/'.$id);
        }

        $devpub = Devpub::findOrfail($id);
        return view('devpub.show',compact('title','devpub'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $title = 'Edit - devpub';
        if($request->ajax())
        {
            return URL::to('devpub/'. $id . '/edit');
        }

        
        $devpub = Devpub::findOrfail($id);
        return view('devpub.edit',compact('title','devpub'  ));
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
        $devpub = Devpub::findOrfail($id);
    	
        $devpub->devpubname = $request->devpubname;
        
        $devpub->devpubslug = $request->devpubslug;
        
        $devpub->devpubtype = $request->devpubtype;
        
        $devpub->is_great = $request->is_great;
        
        
        $devpub->save();

        return redirect('devpub');
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
        $msg = Ajaxis::BtDeleting('Warning!!','Would you like to remove This?','/devpub/'. $id . '/delete');

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
     	$devpub = Devpub::findOrfail($id);
     	$devpub->delete();
        return URL::to('devpub');
    }
}
