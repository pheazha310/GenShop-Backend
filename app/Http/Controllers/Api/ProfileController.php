<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        return $request->user();
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
        ]);

        $request->user()->update($data);

        return $request->user();
    }

    public function changePassword(Request $request)
    {
        $data = $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        abort_unless(Hash::check($data['current_password'], $request->user()->password), 422, 'Current password is invalid');

        $request->user()->update([
            'password' => Hash::make($data['password']),
        ]);

        return response()->json(['message' => 'Password updated']);
    }
}
