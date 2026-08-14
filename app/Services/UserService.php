<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserService
{
    public function getAllUsers()
    {
        $paginator = DB::table('users as a')
            ->join('KeyPermission as b', 'a.keyID', '=', 'b.id')
            ->join('Permission as c', 'b.permissionID', '=', 'c.id')
            ->select(
                'a.id as id',
                'a.name',
                'a.email',
                'c.name as permissionName',
                'a.created_at as createdDate'
            )
            ->orderByDesc('a.created_at')
            ->paginate(10);

        $paginator->getCollection()->transform(function ($value) {
            return [
                'id' => $value->id,
                'name' => $value->name,
                'email' => $value->email,
                'status' => $value->permissionName,
                'since' => Carbon::parse($value->createdDate)->format('Y-m-d'),
            ];
        });

        return $paginator;
    }

    public function getSingleUser($id)
    {
        return User::find($id);
    }
}
