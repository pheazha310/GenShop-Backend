<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $perPage = max(1, min(100, request()->integer('per_page', 15)));

        return User::query()
            ->withCount('orders')
            ->latest()
            ->paginate($perPage);
    }
}
