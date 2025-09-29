<?php

namespace App\Http\Controllers\admin;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class CourseController extends Controller
{

    public function index(Request $request): JsonResponse
    {
        $user = User::where('role', 'instructor')->orderBy('id', 'desc')->get();
        $query = Course::with('instructor')->orderBy('id','desc');
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")->orWhere('price', 'like', "%{$search}%");
            });
        }
        $perPage = $request->get('per_page', 10);
        $page = $request->get('page', 1);
        $items = $query->orderBy('created_at', 'desc')->paginate($perPage, ['*'], 'page', $page);
        $from = ($items->currentPage() - 1) * $items->perPage() + 1;
        $to   = min($items->currentPage() * $items->perPage(), $items->total());
        return response()->json([
            'user' => $user,
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

    public function store (Request $request): JsonResponse
    {
        try {
            $request->validate([
                'thumbnail' => 'nullable|max:2048',
                'instructor_id' => 'required|string|max:255',
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'price' => 'required|string|max:255',
                'status' => 'required|string|max:255',
            ]);
            $imagePath = null;
            if ($request->hasFile('thumbnail')) {
                $file = $request->file('thumbnail');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                Storage::disk('public')->put($filename, file_get_contents($file));
                $imagePath = $filename;
            }
            $item = Course::create([
                'thumbnail' => $imagePath,
                'instructor_id' => $request->instructor_id,
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'status' => $request->status,
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
        $data = Course::with('instructor')->find($id);
        if (!$data) {
            return response()->json(['message' => 'data not found'], 404);
        }
        return response()->json(['data' => $data], 200);
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            $data = Course::find($id);
            if (!$data) {
                return response()->json(['message' => 'Data not found'], 404);
            }
            $request->validate([
                'thumbnail' => 'nullable|max:2048',
                'instructor_id' => 'required|string|max:255',
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'price' => 'required|string|max:255',
                'status' => 'required|string|max:255',
            ]);
            if ($request->hasFile('thumbnail')) {
                if ($data->thumbnail && Storage::disk('public')->exists($data->thumbnail)) {
                    Storage::disk('public')->delete($data->thumbnail);
                }
                $file = $request->file('thumbnail');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                Storage::disk('public')->put('' . $filename, file_get_contents($file));
                $data->thumbnail = '' . $filename;
            }
            if ($request->filled('instructor_id')) {
                $data->instructor_id = $request->instructor_id;
            }
            if ($request->filled('title')) {
                $data->title = $request->title;
            }
            if ($request->filled('description')) {
                $data->description = $request->description;
            }
            if ($request->filled('price')) {
                $data->price = $request->price;
            }
            if ($request->filled('status')) {
                $data->status = $request->status;
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
            $data = Course::find($id);
            if (!$data) { return response()->json(['message' => 'Data not found'], 404); }
            if ($data->thumbnail && Storage::disk('public')->exists($data->thumbnail)) {
                Storage::disk('public')->delete($data->thumbnail);
            }
            $data->delete();
            return response()->json(['message' => 'Data deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json([ 'message' => 'Something went wrong', 'error'   => $e->getMessage() ], 500);
        }
    }

}
