<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotificationRequest;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class NotificationController extends Controller
{
    public $baseViewDirectory = 'admin.notifications.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->baseViewDirectory . 'index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view($this->baseViewDirectory . 'create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param NotificationRequest $request
     * @return array
     */
    public function store(NotificationRequest $request)
    {
        try {
            $input = $request->only('title', 'short_description', 'description');
            $userIds = $request->get('user_ids');
            if ($userIds && !isEmptyArray($userIds)) {
                $input['user_ids'] = $userIds;
            }
            Notification::create($input);
            return redirect('/notifications')->with('success', 'Notification Send Successfully!');
        } catch (\Throwable $exception) {
            return redirect('/notifications')->with('error', 'Unable to Send Notification!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notification = Notification::findOrFail($id);
        $users = User::whereIn('id', ($notification->user_ids ?? []))->get();
        return view($this->baseViewDirectory . 'show', compact('notification', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $notification = Notification::findOrFail($id);
        $users = User::all();
        return view($this->baseViewDirectory . 'edit', compact('notification', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param NotificationRequest $request
     * @param int $id
     * @return void
     */
    public function update(NotificationRequest $request, $id)
    {
        try {
            $notification = Notification::findOrFail($id);
            $input = $request->only('title', 'short_description', 'description');
            $userIds = $request->get('user_ids');
            $input['user_ids'] = ($userIds && !isEmptyArray($userIds)) ? $userIds : null;
            $notification->update($input);
            return redirect('/notifications')->with('success', 'Notification Updated Successfully!');
        } catch (\Throwable $exception) {
            return redirect('/notifications')->with('error', 'Unable to Update Notification Details!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $notification = Notification::findOrFail($id);
            $notification->delete();
            return response()->json(['action' => 'success', 'message' => 'Notification deleted successfully']);
        } catch (\Throwable $exception) {
            return response()->json(['action' => 'error', 'message' => 'Unable to delete Notification'], 500);
        }
    }

    /**
     * Get Users list for Datatable
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function getNotifications(Request $request)
    {
        return DataTables::eloquent(Notification::whereType(NOTIFICATION_TYPE_GENERAL))
            ->editColumn('users_count', function ($notification) {
                return $notification->user_ids ? count($notification->user_ids) : 'All';
            })
            ->addColumn('action', function ($notification) {
                $buttons = '';
                if (auth()->user()->can('notifications.view')) {
                    $buttons .= viewButton(route("notifications.show", $notification->id));
                }
                if (auth()->user()->can('notifications.edit')) {
                    $buttons .= editButton(route("notifications.edit", $notification->id));
                }
                if (auth()->user()->can('notifications.delete')) {
                    $buttons .= deleteButton(route("notifications.delete", $notification->id), $notification->title);
                }
                $buttons = ($buttons != '') ? $buttons : '-';
                return '<div class="form-inline justify-content-center">' . $buttons . '</div>';
            })
            ->make(true);
    }

    /**
     * Get list of notifications for the logged in user.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserNotifications()
    {
        try {
            $notifications = Notification::where('created_at', '>=', auth()->user()->notification_read_at)->where(function ($query) {
                $query->whereNull('user_ids')
                    ->orWhereJsonContains('user_ids', (string)auth()->id());
            })->latest()->limit(MAXIMUM_NOTIFICATION_COUNT_IN_SIDEBAR)->get();
            authNotificationReadedNow();
            return response()->json(['action' => 'success', 'data' => $notifications]);
        } catch (\Throwable $exception) {
            return response()->json(['action' => 'error', 'message' => 'Unable to get Notifications!'], 500);
        }
    }
}
