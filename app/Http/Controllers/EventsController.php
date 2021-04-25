<?php

namespace App\Http\Controllers;

use App\Jobs\SendNotification;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $args = $request->all();

        $fromDate = $args['from'] ?? 0;
        $toDate = $args['to'] ?? 0;
        $events = array();
        if (!empty($fromDate) && !empty($toDate)) {
            $fromDate = $fromDate .' 23:59:59';
            $toDate = $toDate .' 23:59:59';
            $allEvents = Event::whereBetween('event_date', [$fromDate, $toDate])->get();
            $events = $allEvents->toArray();
        }
        
        $view = view("events.view")->with('htmldata', $events)->render();
        return response()->json(['htmldata'=>$view]);
    }

    public function submitEvents(Request $request)
    {
        $args = $request->all();
        if (empty($args['ids'])) {
            return response()->json([
                'msg' => "No event found!"
            ], 400);
        }
        $eventIds = $args['ids'];

        $arrEventIds = explode(",", $eventIds);
        
        $userIds =Event::whereIn('id', $arrEventIds)->pluck('interested_users');

        if (empty($userIds)) {
            return response()->json([
                'msg' => "No user found!"
            ], 400);
        }
        $arrEventsWithUsers = $userIds->toArray();
        $arrUsers = array();
        if (!empty($arrEventsWithUsers)) {
            foreach ($arrEventsWithUsers as $users) {
                $arrUsers = array_merge($arrUsers, explode(",", $users));
            }
        }
        $arrUsers = array_unique($arrUsers);
        
        //get All users
        $arrInvitedUser = User::whereIn('id', $arrUsers)->get()->toArray();

        if (!empty($arrInvitedUser)) {
            //send mail from queue
            SendNotification::dispatch('email', $arrInvitedUser);
        }

        return response()->json([
            'msg' => "Notification send successfully!"
        ], 200);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
