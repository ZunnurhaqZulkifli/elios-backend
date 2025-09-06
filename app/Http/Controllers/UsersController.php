<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        // $this->authorizeResource(User::class, 'user');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('users/list', [
            'title' => __('users.titles.index'),
            'users' => UserResource::collection(User::all()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('users/create', [
            'title' => __('users.title'),
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): Response
    {
        $model = $user->load(['profile', 'roles']);

        return Inertia::render('users/edit', [
            'title' => __('users.title'),
            'model' => UserResource::make($model)
        ]);
    }
}
