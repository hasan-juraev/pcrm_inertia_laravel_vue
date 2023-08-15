<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\Auth\LoginController;


Route::get('login', [LoginController::class, 'create'])->name('login');
Route::post('login', [LoginController::class, 'store']);
Route::post('logout', [LoginController::class, 'destroy'])->middleware('auth');

Route::middleware('auth')->group( function () {

    Route::get('/', function () {
        return \Inertia\Inertia::render('Welcome',
            [
                'name' => 'Hasan',
                'frameworks' => [
                    'Laravel',
                    'Vue',
                    'React'
                ],
            ]
        );
    });
    Route::get('/users/create', function () {
        return \Inertia\Inertia::render('User/Create');
    })->can('create', 'App\Models\User');

    Route::post('/users', function () {
        Request::validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        User::create([
            'name' => Request::input('name'),
            'email' => Request::input('email'),
            'password' => Request::input('password'),
        ]);

        return redirect('/users');
    });

    Route::get('/users', function () {
        return \Inertia\Inertia::render('User/Index', [
            'time' => now()->toTimeString(),
            'users' => \App\Models\User::query()
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('name', 'like', "%{$search}%");
                })
                ->paginate(10)
                ->withQueryString()
                ->through(fn($user) => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'can' => [
                        'edit' => Auth::user()->can('edit', $user)
                    ]
                ]
            ),
            'filters' => Request(['search']),
            'can' => [
                'createUser' => Auth::user()->can('create', User::class)
            ]
        ]);
    });

    Route::get('/about', function () {
        return \Inertia\Inertia::render('About');
    });

    Route::get('/settings', function () {
        return \Inertia\Inertia::render('Settings');
    });
});
