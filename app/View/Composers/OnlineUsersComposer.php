<?php

namespace App\View\Composers;

use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class OnlineUsersComposer
{
    public function compose(View $view)
    {
        $view->with('numOfOnlineUsers', Cache::get('online-users-counter', 1));
    }
}
