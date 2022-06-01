<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Exception;
use Psy\Util\Json;
use App\Models\Request as RequestModel;

class RequestController extends Controller
{
    public function index(): JsonResponse{
        $requestsmodel = RequestModel::all();
        return response()->json($requestsmodel, 200);
    }


    public function getByUserIdAndOfferId(Request $request): JsonResponse{
        $requestmodel = RequestModel::where(["user_id", "=", $request->input('user_id')],
            ["offer_id", "=", $request->input("offer_id")]);
        return response()->json($requestmodel, 200);
    }

    public function getById(string $id): JsonResponse{
        $requestmodel = RequestModel::find($id);
        return response()->json($requestmodel, 200);
    }

    public function save(Request $request): JsonResponse{
        DB::beginTransaction();
        try{
            $requestmodel = RequestModel::create($request->all());
            DB::commit();
            return response()->json($requestmodel, 201);
        }
        catch(Exception $e){
            DB::rollBack();
            return response()->json('saving request failed: ' . $e->getMessage(), 420);
        }
    }

    public function update(Request $request, string $id) : JsonResponse{
        DB::beginTransaction();
        try{
            $requestmodel = RequestModel::find($id);
            $requestmodel->update($request->all());

            DB::commit();
            return response()->json($requestmodel, 201);
        }
        catch(Exception $e){
            DB::rollBack();
            return response()->json('updating request failed: ' . $e->getMessage(), 420);
        }
    }

    public function delete(string $id) : JsonResponse{
        $requestmodel = RequestModel::find($id);

        if($requestmodel){
            $requestmodel->delete();
            return response()->json('request with id: ' . $id . ' was successfully deleted', 200);
        }
        return response()->json('request with id: ' . $id . ' wasnt deleted (does not exist)', 420);
    }
}
