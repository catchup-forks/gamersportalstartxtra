<?php

namespace Modules\Platforms\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Platform;
use Amranidev\Ajaxis\Ajaxis;
use URL;

/**
 * Class PlatformController.
 *
 * @author  The scaffold-interface created at 2016-12-25 05:17:55pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class PlatformController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Index - platform';
        $platforms = Platform::paginate(6);
        return view('platform.index',compact('platforms','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create - platform';
        
        return view('platform.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $platform = new Platform();

        
        $platform->platformname = $request->platformname;

        
        $platform->platformslug = $request->platformslug;

        
        $platform->showonmainpage = $request->showonmainpage;

        
        
        $platform->save();

        $pusher = App::make('pusher');

        //default pusher notification.
        //by default channel=test-channel,event=test-event
        //Here is a pusher notification example when you create a new resource in storage.
        //you can modify anything you want or use it wherever.
        $pusher->trigger('test-channel',
                         'test-event',
                        ['message' => 'A new platform has been created !!']);

        return redirect('platform');
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
        $title = 'Show - platform';

        if($request->ajax())
        {
            return URL::to('platform/'.$id);
        }

        $platform = Platform::findOrfail($id);
        return view('platform.show',compact('title','platform'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $title = 'Edit - platform';
        if($request->ajax())
        {
            return URL::to('platform/'. $id . '/edit');
        }

        
        $platform = Platform::findOrfail($id);
        return view('platform.edit',compact('title','platform'  ));
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
        $platform = Platform::findOrfail($id);
    	
        $platform->platformname = $request->platformname;
        
        $platform->platformslug = $request->platformslug;
        
        $platform->showonmainpage = $request->showonmainpage;
        
        
        $platform->save();

        return redirect('platform');
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
        $msg = Ajaxis::BtDeleting('Warning!!','Would you like to remove This?','/platform/'. $id . '/delete');

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
     	$platform = Platform::findOrfail($id);
     	$platform->delete();
        return URL::to('platform');
    }
}
