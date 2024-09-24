<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', User::class);

        if (request()->wantsJson()) {
            return UserResource::collection(User::with('invoices')->get());
        }

        return inertia('Users/Index', [
            'users' => UserResource::collection(User::with('invoices')->get()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', User::class);

        return inertia('Users/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $request->validated();
        User::create($request->validated());

        if ($request->wantsJson()) {
            return response()->json([
                                        'status'  => 'success',
                                        'message' => 'User created successfully',
                                    ]);
        }

        return to_route('users.index')->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        Gate::authorize('view', $user);

        if (request()->wantsJson()) {
            return UserResource::make($user->load('invoices'));
        }

        return inertia('Users/Show', [
            'user' => UserResource::make($user->load('invoices')),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return inertia('Users/Edit', [
            'user' => UserResource::make($user),
        ]);
    }

    /**
     * InvoiceUpdate the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $request->validated();
        $user->update($request->validated());

        if ($request->wantsJson()) {
            return response()->json([
                                        'status'  => 'success',
                                        'message' => 'User updated successfully',
                                    ]);
        }

        return to_route('users.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        Gate::authorize('forceDelete', $user);

        $user->forceDelete();

        if (request()->wantsJson()) {
            return response()->json([
                                        'status'  => 'success',
                                        'message' => 'User deleted successfully',
                                    ]);
        }

        return to_route('users.index')->with('success', 'User deleted successfully');
    }
}
