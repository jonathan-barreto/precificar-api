<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StoryController extends Controller
{
    //
    const EXPIRATION_HOURS = 1;

    public function getUserStories(Request $request)
    {
        $user_id = $request->id;

        $stories = Story::where('user_id', $user_id)->where('expiration_date', '>', now())->get();

        if ($stories->isNotEmpty()) {
            return response()->json(['stories' => $stories], 200);
        }

        return response()->json(['stories' => []], 200);
    }

    public function uploadStory(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            try {
                $story = $this->saveImage($request, $image);
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }

            return response()->json(['message' => 'Upload do story foi concluído com sucesso!']);
        }

        return response()->json($request);
    }

    private function saveImage($request, $image)
    {
        $story = new Story();

        $story->user_id = $request->user_id;
        $story->path_image_story = uniqid() . '.' . $image->getClientOriginalExtension();
        $story->subtitle_story = $request->subtitle_story;
        $story->expiration_date = Carbon::now()->addHours(self::EXPIRATION_HOURS);

        $story->save();

        $image->storeAs('public/stories-images/', $story->path_image_story);

        return $story;
    }
}
