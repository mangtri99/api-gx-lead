<?php

namespace App\Repository\User;

use App\Interface\CrudInterface;

use App\Models\User;

use Illuminate\Http\Request;

class UserRepository implements CrudInterface
{
    public function getAll(Request $request)
    {
        return User::all();
    }

    public function getById(int $id)
    {
        return User::findOrfail($id);
    }

    public function create(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        return $user;
    }

    public function update(Request $request, int $id)
    {
        $user = User::findOrfail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password){
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return $user;
    }

    public function delete(int $id)
    {
        $user = User::findOrfail($id);
        $user->delete();
        return $user;
    }
}
