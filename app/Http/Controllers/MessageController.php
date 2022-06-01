<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Exception;
use Psy\Util\Json;
use App\Models\Message;
use Illuminate\Database\Eloquent\Builder;

class MessageController extends Controller
{
    public function index(): JsonResponse{
        $messages = Message::all();
        return response()->json($messages, 200);
    }

    public function getById(string $id): JsonResponse{
        $message = Message::find($id);
        return response()->json($message, 200);
    }

    public function getByOfferId(string $id): JsonResponse{
        $message = Message::with("user", "offer")->where("offer_id", $id)->get();
        return response()->json($message, 200);
    }

    public function getByUserId(string $id): JsonResponse{
      /*  $posts = Post::whereHas('comments', function (Builder $query) {
            $query->where('content', 'like', 'code%');
        })->get();
      */
        $message = Message::with("user", "offer")->whereHas('offer',
            function (Builder $query) use($id) {$query->where('user_id', $id);})->get();
        return response()->json($message, 200);
    }

    public function save(Request $request): JsonResponse{
        DB::beginTransaction();
        try{
            $message = Message::create($request->all());
            DB::commit();
            return response()->json($message, 201);
        }
        catch(Exception $e){
            DB::rollBack();
            return response()->json('saving message failed: ' . $e->getMessage(), 420);
        }
    }

    public function update(Request $request, string $id) : JsonResponse{
        DB::beginTransaction();
        try{
            $message = Message::find($id);
            $message->update($request->all());

            DB::commit();
            return response()->json($message, 201);
        }
        catch(Exception $e){
            DB::rollBack();
            return response()->json('updating message failed: ' . $e->getMessage(), 420);
        }
    }

    public function delete(string $id) : JsonResponse{
        $message = Message::find($id);

        if($message){
            $message->delete();
            return response()->json('message with id: ' . $id . ' was successfully deleted', 200);
        }
        return response()->json('message with id: ' . $id . ' wasnt deleted (does not exist)', 420);
    }
}
