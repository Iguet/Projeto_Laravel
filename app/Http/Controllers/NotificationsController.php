<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\NovaDemanda;
use App\User;
use auth;

class NotificationsController extends Controller
{
    
    public function send(Request $request, User $users, NovaDemanda $notification)
    {

        // $user = $users->find($request->idUser);

        // // $notifications = $user->notifications;

        // // foreach ($user->notifications as $key) {
            
        // //     $data[] = $key->data['message'];

        // // }

        // $result = $user->notify($notification);

        // echo json_encode($result);

        // // 'notifications'=> $data

    }

    public function read()
    {
    
        $user = Auth::user();
        
        foreach ($user->unreadNotifications as $notification) {

            $notification->markAsRead();

        }


        // echo json_encode($dados);
        

    }

}
