<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserRepo
{
    public static function create(array $params): mixed
    {
        return User::create([
            'name' => $params['name'],
            'email' => $params['email'],
            'password' => $params['password'],
            'group_user_id' => $params['group_user'],
            'situation' => 'A',
        ]);
    }

    public static function show(): mixed
    {
        return User::join('group_user', 'group_user.id', '=', 'users.group_user_id')
            ->where('users.situation', 'A')
            ->select('users.id', 'users.name as user_name', 'group_user.id as group_id', 'group_user.name as group_name')
            ->get();
    }
}
