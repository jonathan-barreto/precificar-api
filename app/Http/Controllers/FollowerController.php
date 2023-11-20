<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Followers;

class FollowerController extends Controller
{
    //
    public function followUser(Request $request)
    {

        $followerId = $request->input('follower_id');
        $followedId = $request->input('followed_id');

        $usuarioSeguido = User::find($followedId);

        $relacaoExistente = Followers::where('follower_id', $followerId)->where('followed', $followedId)->exists();

        if (!$relacaoExistente) {
            Followers::create([
                'follower_id' => $followerId,
                'followed' => $followedId,
            ]);
        }

        $response = $this->returnArray($usuarioSeguido, true);

        return response()->json($response);
    }

    public function unfollowUser(Request $request)
    {
        $followerId = $request->input('follower_id');
        $followedId = $request->input('followed_id');

        $usuarioSeguido = User::find($followedId);

        $relacaoExistente = Followers::where('follower_id', $followerId)->where('followed', $followedId)->exists();

        if ($relacaoExistente) {
            Followers::where('follower_id', $followerId)->where('followed', $followedId)->delete();
        }

        $response = $this->returnArray($usuarioSeguido, false);

        return response()->json($response);
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
