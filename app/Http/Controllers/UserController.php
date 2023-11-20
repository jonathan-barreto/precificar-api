<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Followers;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function followingUsers(Request $request)
    {
        $userId = $request->id;

        $user = User::findOrFail($userId);

        $usuariosSeguindo = User::select('users.*')
            ->join('followers', 'users.id', '=', 'followers.followed')
            ->where('followers.follower_id', '=', $userId)
            ->whereHas('stories', function ($query) {
                $query->where('expiration_date', '>', now());
            })
            ->get();

        $usuariosSeguindoOrdenados = $usuariosSeguindo->sortByDesc(function ($usuario) {
            return $usuario->stories()->where('expiration_date', '>', now())->max('created_at');
        });

        $response = [
            "current_user" => $user,
            "users" => $usuariosSeguindoOrdenados->values()->all(),
        ];

        return response()->json($response);
    }

    public function getUsersList(Request $request)
    {
        $userId = $request->id;

        $usuariosSeguindo = User::select('users.*')
            ->join('followers', 'users.id', '=', 'followers.followed')
            ->where('followers.follower_id', '=', $userId)
            ->get();

        $todosUsuarios = User::where('id', '!=', $userId)->get();

        $usuariosNaoSeguindo = $todosUsuarios->diff($usuariosSeguindo);

        $listUsers = [];

        for ($i = 0; $i < count($usuariosSeguindo); $i++) {
            $user = $this->returnArray($usuariosSeguindo[$i], true);
            array_push($listUsers, $user);
        }

        for ($i = 0; $i < count($usuariosNaoSeguindo); $i++) {
            $user = $this->returnArray($usuariosNaoSeguindo[$i], false);
            array_push($listUsers, $user);
        }

        return response()->json($listUsers);
    }

    private function returnArray($array, $following)
    {
        $newArray = [
            "id" => $array["id"],
            "name" => $array["name"],
            "following" => $following,
        ];

        return $newArray;
    }
}
