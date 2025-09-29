<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class EnrollmentController extends Controller
{

    public function index(Request $request): JsonResponse
    {
        $user = User::where('role','student')->orderBy('id', 'desc')->get();
        $course = Course::orderBy('id', 'desc')->get();
        $query = Enrollment::with(['user','course'])->orderBy('id','desc');
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('user', function ($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%");
                })->orWhereHas('course', function ($courseQuery) use ($search) {
                    $courseQuery->where('title', 'like', "%{$search}%");
                });
            });
        }
        $perPage = $request->get('per_page', 10);
        $page = $request->get('page', 1);
        $items = $query->orderBy('created_at', 'desc')->paginate($perPage, ['*'], 'page', $page);
        $from = ($items->currentPage() - 1) * $items->perPage() + 1;
        $to   = min($items->currentPage() * $items->perPage(), $items->total());
        return response()->json([
            'user' => $user,
            'course' => $course,
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
                'user_id' => 'required|string|max:255',
                'course_id' => 'required|string|max:255',
                'progress' => 'required|string',
            ]);
            $item = Enrollment::create([
                'user_id' => $request->user_id,
                'course_id' => $request->course_id,
                'progress' => $request->progress,
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
        $data = Enrollment::with(['user','course'])->find($id);
        if (!$data) {
            return response()->json(['message' => 'data not found'], 404);
        }
        return response()->json(['data' => $data], 200);
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            $data = Enrollment::find($id);
            if (!$data) {
                return response()->json(['message' => 'Data not found'], 404);
            }
            $request->validate([
                'user_id' => 'required|string|max:255',
                'course_id' => 'required|string|max:255',
                'progress' => 'required|string',
            ]);
            if ($request->filled('user_id')) {
                $data->user_id = $request->user_id;
            }
            if ($request->filled('course_id')) {
                $data->course_id = $request->course_id;
            }
            if ($request->filled('progress')) {
                $data->progress = $request->progress;
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
            $data = Enrollment::find($id);
            if (!$data) { return response()->json(['message' => 'Data not found'], 404); }
            $data->delete();
            return response()->json(['message' => 'Data deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json([ 'message' => 'Something went wrong', 'error'   => $e->getMessage() ], 500);
        }
    }

}
