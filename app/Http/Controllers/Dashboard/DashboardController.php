<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    // public function MarkAsRead_all(Request $request)
    // {
    //     $userUnreadNotification = auth()->user()->unreadNotifications;

    //     if ($userUnreadNotification) {
    //         $userUnreadNotification->markAsRead();
    //         return back();
    //     }
    // }
}
