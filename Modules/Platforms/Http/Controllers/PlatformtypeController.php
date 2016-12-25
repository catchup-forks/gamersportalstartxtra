<?php

namespace Modules\Platforms\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Platformtype;
use Amranidev\Ajaxis\Ajaxis;
use URL;

/**
 * Class PlatformtypeController.
 *
 * @author  The scaffold-interface created at 2016-12-25 05:17:03pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class PlatformtypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Index - platformtype';
        $platformtypes = Platformtype::paginate(6);
        return view('platformtype.index',compact('platformtypes','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create - platformtype';
        
        return view('platformtype.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $platformtype = new Platformtype();

        
        $platformtype->platformtype = $request->platformtype;

        
        
        $platformtype->save();

        $pusher = App::make('pusher');

        //default pusher notification.
        //by default channel=test-channel,event=test-event
        //Here is a pusher notification example when you create a new resource in storage.
        //you can modify anything you want or use it wherever.
        $pusher->trigger('test-channel',
                         'test-event',
                        ['message' => 'A new platformtype has been created !!']);

        return redirect('platformtype');
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
        $title = 'Show - platformtype';

        if($request->ajax())
        {
            return URL::to('platformtype/'.$id);
        }

        $platformtype = Platformtype::findOrfail($id);
        return view('platformtype.show',compact('title','platformtype'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $title = 'Edit - platformtype';
        if($request->ajax())
        {
            return URL::to('platformtype/'. $id . '/edit');
        }

        
        $platformtype = Platformtype::findOrfail($id);
        return view('platformtype.edit',compact('title','platformtype'  ));
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
        $platformtype = Platformtype::findOrfail($id);
    	
        $platformtype->platformtype = $request->platformtype;
        
        
        $platformtype->save();

        return redirect('platformtype');
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
        $msg = Ajaxis::BtDeleting('Warning!!','Would you like to remove This?','/platformtype/'. $id . '/delete');

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
     	$platformtype = Platformtype::findOrfail($id);
     	$platformtype->delete();
        return URL::to('platformtype');
    }
}
