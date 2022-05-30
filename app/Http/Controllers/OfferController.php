<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Exception;
use Psy\Util\Json;
use App\Models\Offer;

class OfferController extends Controller
{
    public function index(): JsonResponse{
        //$offers = Offer::all();
        $offers = Offer::with("user", "subject")->get();
        return response()->json($offers, 200);
    }

    public function getById(string $id): JsonResponse{
        $offer = Offer::where("id", $id)->with("user", "subject")->get();
        return response()->json($offer[0], 200);
    }

    public function save(Request $request): JsonResponse{
        DB::beginTransaction();
        try{
            $offer = Offer::create($request->all());
            DB::commit();
            return response()->json($offer, 201);
        }
        catch(Exception $e){
            DB::rollBack();
            return response()->json('saving offer failed: ' . $e->getMessage(), 420);
        }
    }

    public function update(Request $request, string $id) : JsonResponse{
        DB::beginTransaction();
        try{
            $offer = Offer::find($id);
            $offer->update($request->all());

            DB::commit();
            return response()->json($offer, 201);
        }
        catch(Exception $e){
            DB::rollBack();
            return response()->json('updating offer failed: ' . $e->getMessage(), 420);
        }
    }

    public function delete(string $id) : JsonResponse{
        $offer = Offer::find($id);

        if($offer){
            $offer->delete();
            return response()->json('offer with id: ' . $id . ' was successfully deleted', 200);
        }
        return response()->json('offer with id: ' . $id . ' wasnt deleted (does not exist)', 420);
    }
}
