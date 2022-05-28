<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\Subject;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Exception;
use Psy\Util\Json;

class SubjectController extends Controller
{
    public function index(): JsonResponse{
        $subjects = Subject::all();
        return response()->json($subjects, 200);
    }

    public function getById(string $id): JsonResponse{
        $subject = Subject::find($id);
        return response()->json($subject, 200);
    }

    public function save(Request $request): JsonResponse{
        // Transaktion hier eigentlich nicht notwendig
        DB::beginTransaction();
        try{
            $subject = Subject::create($request->all());
            DB::commit();
            return response()->json($subject, 201);
        }
        catch(Exception $e){
            DB::rollBack();
            return response()->json('saving subject failed: ' . $e->getMessage(), 420);
        }
    }

    public function update(Request $request, string $id) : JsonResponse{
        DB::beginTransaction();
        try{
            $subject = Subject::find($id);
            $subject->update($request->all());

            DB::commit();
            return response()->json($subject, 201);
        }
        catch(Exception $e){
            DB::rollBack();
            return response()->json('updating subject failed: ' . $e->getMessage(), 420);
        }
    }

    public function delete(string $id) : JsonResponse{
        $subject = Subject::find($id);

        if($subject){
            $subject->delete();
            return response()->json('subject with id: ' . $id . ' was successfully deleted', 200);
        }
        return response()->json('subject with id: ' . $id . ' wasnt deleted (does not exist)', 420);
    }
}
