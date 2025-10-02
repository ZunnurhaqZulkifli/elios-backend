<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UsersApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->get('per_page', 10);
        $page = $request->get('page', 1);
        
        $users = User::query()
            ->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'data' => $users->items(),
            'total' => $users->total(),
            'per_page' => $users->perPage(),
            'current_page' => $users->currentPage(),
            'last_page' => $users->lastPage(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'sometimes|string|max:255',
            'status' => 'sometimes|string|in:active,inactive',
        ]);

        // Set default values
        $validated['role'] = $validated['role'] ?? 'User';
        $validated['status'] = $validated['status'] ?? 'active';
        $validated['password'] = bcrypt('password'); // Default password
        $validated['email_verified_at'] = now();

        $user = User::create($validated);

        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): JsonResponse
    {
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'sometimes|string|max:255',
            'status' => 'sometimes|string|in:active,inactive',
        ]);

        $user->update($validated);

        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): JsonResponse
    {
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }

    /**
     * Search users
     */
    public function search(Request $request): JsonResponse
    {
        $query = $request->get('q', '');
        
        if (strlen($query) < 2) {
            return response()->json(['data' => []]);
        }

        $users = User::where('name', 'like', "%{$query}%")
                    ->orWhere('email', 'like', "%{$query}%")
                    ->limit(10)
                    ->get();

        dd($users);

        return response()->json(['data' => $users]);
    }
}
