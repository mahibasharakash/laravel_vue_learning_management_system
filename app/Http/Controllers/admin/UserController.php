<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{

    public function login(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
        } catch (ValidationException $e) {
            return response()->json( [ 'errors' => $e->errors() ], 422 );
        }
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json( [ 'message' => 'Invalid credentials' ], 401 );
        }
        $user = Auth::user();
        $token = $user->createToken('authToken')->plainTextToken;
        return response()->json( [ 'message' => 'Logged in successfully', 'user' => $user, 'token' => $token ] );
    }

    public function registration(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:5|confirmed',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $token = $user->createToken('authToken')->plainTextToken;
        return response()->json( [ 'message' => 'Registration successful', 'user' => $user, 'token' => $token ], 201 );
    }

    public function forgot(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'email' => 'required|email|exists:users,email',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
        $user = User::where('email', $request->email)->first();
        if (!$user->email_verified_at) {
            $code = rand(100000, 999999);
            $user->verification_code = $code;
            $user->save();
            Mail::raw("Your verification code is: {$code}", function ($message) use ($user) {
                $message->to($user->email)
                    ->subject('Email Verification Code');
            });
            return response()->json( [ 'message' => 'Email not verified. Verification code sent.', 'type' => 'verification' ] );
        }
        $resetCode = rand(100000, 999999);
        $user->reset_code = $resetCode;
        $user->save();
        Mail::raw("Your password reset code is: {$resetCode}", function ($message) use ($user) {
            $message->to($user->email)
                ->subject('Password Reset Code');
        });
        return response()->json( [ 'message' => 'Password reset code sent.', 'type' => 'reset' ] );
    }

    public function reset(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'email' => 'required|email|exists:users,email',
                'reset_code' => 'required|string',
                'password' => 'required|confirmed|min:5',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
        $user = User::where('email', $request->email)->first();
        if (!$user || is_null($user->email_verified_at)) {
            return response()->json(['message' => 'User not verified'], 400);
        }
        if ($user->reset_code !== $request->reset_code) {
            return response()->json(['message' => 'Invalid reset code'], 400);
        }
        $user->password = Hash::make($request->password);
        $user->reset_code = null; // clear code after use
        $user->save();
        return response()->json( [ 'message' => 'Password reset successful' ] );
    }

    public function verification(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'email' => 'required|email|exists:users,email',
                'verification_code' => 'required|string',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        if ($user->email_verified_at) {
            return response()->json(['message' => 'Email already verified']);
        }
        if ((string)$user->verification_code !== (string)$request->verification_code) {
            return response()->json(['message' => 'Invalid verification code'], 400);
        }
        $user->email_verified_at = now();
        $user->verification_code = null;
        $resetCode = rand(100000, 999999);
        $user->reset_code = $resetCode;
        $user->save();
        Mail::raw("Your email has been verified successfully. Here is your reset code: {$resetCode}", function ($message) use ($user) {
            $message->to($user->email)
                ->subject('Email Verified');
        });
        return response()->json( [ 'message' => 'Email verified successfully', 'reset_code' => $resetCode ] );
    }

    public function details(Request $request): JsonResponse
    {
        $user = $request->user();
        return response()->json(['user' => $user]);
    }

    public function changeDetails(Request $request): JsonResponse
    {
        $user = $request->user();
        try {
            $request->validate([
                'name' => 'sometimes|string|max:255',
                'email' => 'sometimes|email|unique:users,email,' . $user->id,
            ]);
        } catch (ValidationException $e) {
            return response()->json( ['errors' => $e->errors() ], 422);
        }
        $user->update($request->only('name', 'email'));
        return response()->json( [ 'message' => 'Details updated successfully', 'user' => $user ] );
    }

    public function changePassword(Request $request): JsonResponse
    {
        $user = $request->user();
        try {
            $request->validate([
                'current_password' => 'required',
                'password' => 'required|confirmed|min:5',
            ]);
        } catch (ValidationException $e) {
            return response()->json( ['errors' => $e->errors() ], 422);
        }
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json( [ 'message' => 'The provided password does not match your current password.' ], 400 );
        }
        $user->update( [ 'password' => Hash::make($request->password) ] );
        return response()->json( [ 'message' => 'Password changed successfully' ] );
    }

    public function logout(Request $request): JsonResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response()->json( [ 'message' => 'Logged out successfully' ] );
    }

    public function deleteAccount(Request $request): JsonResponse
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json( [ 'message' => 'User not found' ], 404);
        }
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $user->delete();
        return response()->json( [ 'message' => 'Account deleted successfully' ], 200);
    }

    public function uploadImage(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
        $user = $request->user();
        if ($request->hasFile('image')) {
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            Storage::disk('public')->put($filename, file_get_contents($file));
            $updateData['image'] = $filename;
        }
        $user->update($updateData);
        return response()->json(['message' => 'Item updated successfully', 'data' => $user]);
    }

    public function removeImage(Request $request): JsonResponse
    {
        $user = $request->user();
        if ($user->image && Storage::disk('public')->exists($user->image)) {
            Storage::disk('public')->delete($user->image);
            $user->image = null;
            $user->save();
            return response()->json(['message' => 'Photo deleted successfully']);
        }
        return response()->json(['message' => 'No photo found to delete.'], 404);
    }

}
