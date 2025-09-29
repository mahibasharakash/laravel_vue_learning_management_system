<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class QuestionController extends Controller
{

    public function index(Request $request): JsonResponse
    {
        $quiz = Quiz::orderBy('id', 'desc')->get();
        $query = Question::with('quiz')->orderBy('id','desc');
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('question', 'like', "%{$search}%");
                $q->whereHas('quiz', function ($userQuery) use ($search) {
                    $userQuery->where('title', 'like', "%{$search}%");
                });
            });
        }
        $perPage = $request->get('per_page', 10);
        $page = $request->get('page', 1);
        $items = $query->orderBy('created_at', 'desc')->paginate($perPage, ['*'], 'page', $page);
        $from = ($items->currentPage() - 1) * $items->perPage() + 1;
        $to   = min($items->currentPage() * $items->perPage(), $items->total());
        return response()->json([
            'quiz' => $quiz,
            'data' => $items->items(),
            'pagination' => [
                'current_page' => $items->currentPage(),
                'per_page' => $items->perPage(),
                'total' => $items->total(),
                'last_page' => $items->lastPage(),
                'from' => $from,
                'to' => $to,
                'summary' => "Showing {$from} to {$to} of {$items->total()} entries"
            ]
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'quiz_id' => 'required|string|max:255',
                'question' => 'required|string|max:255',
                'type' => 'required|string',
            ]);
            $item = Question::create([
                'quiz_id' => $request->quiz_id,
                'question' => $request->question,
                'type' => $request->type,
            ]);
            return response()->json([
                'message' => 'Data created successfully',
                'data'    => $item
            ], 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function show($id): JsonResponse
    {
        $data = Question::with('quiz')->find($id);
        if (!$data) {
            return response()->json(['message' => 'data not found'], 404);
        }
        return response()->json(['data' => $data], 200);
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            $data = Question::find($id);
            if (!$data) {
                return response()->json(['message' => 'Data not found'], 404);
            }
            $request->validate([
                'quiz_id' => 'required|string|max:255',
                'question' => 'required|string|max:255',
                'type' => 'required|string',
            ]);
            if ($request->filled('quiz_id')) {
                $data->quiz_id = $request->quiz_id;
            }
            if ($request->filled('question')) {
                $data->question = $request->question;
            }
            if ($request->filled('type')) {
                $data->type = $request->type;
            }
            $data->save();
            return response()->json([
                'message' => 'Data updated successfully',
                'data'    => $data
            ], 200);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $data = Question::find($id);
            if (!$data) { return response()->json(['message' => 'Data not found'], 404); }
            $data->delete();
            return response()->json(['message' => 'Data deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json([ 'message' => 'Something went wrong', 'error'   => $e->getMessage() ], 500);
        }
    }

}
