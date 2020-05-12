<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\NovaDemanda;
use App\User;
use auth;

class NotificationsController extends Controller
{

    public function read()
    {

        $user = Auth::user();

        foreach ($user->unreadNotifications as $notification) {

            $notification->markAsRead();

        }

    }

}
