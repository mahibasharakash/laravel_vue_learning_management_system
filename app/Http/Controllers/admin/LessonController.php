<?php

namespace App\Http\Controllers\admin;

use App\Models\Section;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class LessonController extends Controller
{

    public function index(Request $request): JsonResponse
    {
        $section = Section::orderBy('id', 'desc')->get();
        $query = Lesson::with('section')->orderBy('id','desc');
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%");
            });
        }
        $perPage = $request->get('per_page', 10);
        $page = $request->get('page', 1);
        $items = $query->orderBy('created_at', 'desc')->paginate($perPage, ['*'], 'page', $page);
        $from = ($items->currentPage() - 1) * $items->perPage() + 1;
        $to   = min($items->currentPage() * $items->perPage(), $items->total());
        return response()->json([
            'section' => $section,
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
                'section_id' => 'required|string|max:255',
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'video_url' => 'required|string|max:255',
                'duration' => 'required|string|max:255',
            ]);
            $item = Lesson::create([
                'section_id' => $request->section_id,
                'title' => $request->title,
                'description' => $request->description,
                'video_url' => $request->video_url,
                'duration' => $request->duration,
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
        $data = Lesson::with('section')->find($id);
        if (!$data) {
            return response()->json(['message' => 'data not found'], 404);
        }
        return response()->json(['data' => $data], 200);
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            $data = Lesson::find($id);
            if (!$data) {
                return response()->json(['message' => 'Data not found'], 404);
            }
            $request->validate([
                'section_id' => 'required|string|max:255',
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'video_url' => 'required|string|max:255',
                'duration' => 'required|string|max:255',
            ]);
            if ($request->filled('section_id')) {
                $data->section_id = $request->section_id;
            }
            if ($request->filled('title')) {
                $data->title = $request->title;
            }
            if ($request->filled('description')) {
                $data->description = $request->description;
            }
            if ($request->filled('video_url')) {
                $data->video_url = $request->video_url;
            }
            if ($request->filled('duration')) {
                $data->duration = $request->duration;
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
            $data = Lesson::find($id);
            if (!$data) { return response()->json(['message' => 'Data not found'], 404); }
            $data->delete();
            return response()->json(['message' => 'Data deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json([ 'message' => 'Something went wrong', 'error'   => $e->getMessage() ], 500);
        }
    }

}
