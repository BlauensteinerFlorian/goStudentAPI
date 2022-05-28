<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Exception;
use Psy\Util\Json;

class UserController extends Controller
{
    public function index(): JsonResponse{
        $users = User::all();
        return response()->json($users, 200);
    }

    public function getById(string $id): JsonResponse{
        $user = User::find($id);
        return response()->json($user, 200);
    }

    public function save(Request $request): JsonResponse{
        DB::beginTransaction();
        try{
            $user = User::create($request->all());
            $user->password = bcrypt($user->password);
            $user->save();
            DB::commit();
            return response()->json($user, 201);
        }
        catch(Exception $e){
            DB::rollBack();
            return response()->json('saving user failed: ' . $e->getMessage(), 420);
        }
    }

    public function update(Request $request, string $id) : JsonResponse{
        DB::beginTransaction();
        try{
            $user = User::find($id);
            $user->update($request->all());
            if(isset($request['password'])){
                $user->password = bcrypt($user->password);
                $user->save();
            }

            DB::commit();
            return response()->json($user, 201);
        }
        catch(Exception $e){
            DB::rollBack();
            return response()->json('updating user failed: ' . $e->getMessage(), 420);
        }
    }

    public function delete(string $id) : JsonResponse{
        $user = User::find($id);

        if($user){
            $user->delete();
            return response()->json('user with id: ' . $id . ' was successfully deleted', 200);
        }
        return response()->json('user with id: ' . $id . ' wasnt deleted (does not exist)', 420);
    }
}
