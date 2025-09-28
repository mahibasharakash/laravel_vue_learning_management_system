<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{

    public function index(Request $request): JsonResponse
    {
        $query = User::where('role', '!=', 'admin')->orderBy('id','desc');
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%");
            });
        }
        $perPage = $request->get('per_page', 10);
        $page = $request->get('page', 1);
        $items = $query->orderBy('created_at', 'desc')->paginate($perPage, ['*'], 'page', $page);
        $from = ($items->currentPage() - 1) * $items->perPage() + 1;
        $to   = min($items->currentPage() * $items->perPage(), $items->total());
        return response()->json([
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
                'image' => 'nullable|max:2048',
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:5|confirmed',
                'role' => 'required|string|max:255',
            ]);
            $imagePath = null;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                Storage::disk('public')->put($filename, file_get_contents($file));
                $imagePath = $filename;
            }
            $item = User::create([
                'image' => $imagePath,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);
            return response()->json([
                'message' => 'User created successfully',
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
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        return response()->json(['user' => $user], 200);
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }
            $request->validate([
                'image' => 'nullable|max:2048',
                'name' => 'sometimes|required|string|max:255',
                'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $id,
                'password' => 'nullable|string|min:5|confirmed',
                'role' => 'sometimes|required|string|max:255',
            ]);
            if ($request->hasFile('image')) {
                if ($user->image && Storage::disk('public')->exists($user->image)) {
                    Storage::disk('public')->delete($user->image);
                }
                $file = $request->file('image');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                Storage::disk('public')->put('' . $filename, file_get_contents($file));
                $user->image = '' . $filename;
            }
            if ($request->filled('name')) {
                $user->name = $request->name;
            }
            if ($request->filled('email')) {
                $user->email = $request->email;
            }
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            if ($request->filled('role')) {
                $user->role = $request->role;
            }
            $user->save();
            return response()->json([
                'message' => 'User updated successfully',
                'data'    => $user
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
            $user = User::find($id);
            if (!$user) { return response()->json(['message' => 'User not found'], 404); }
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }
            $user->delete();
            return response()->json(['message' => 'User deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json([ 'message' => 'Something went wrong', 'error'   => $e->getMessage() ], 500);
        }
    }

}
