<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fio' => 'required|string|max:255',
            'loginReg' => 'required|string|max:255|unique:users,login',
            'email' => 'required|string|email|max:255|unique:users,email',
            'passwordReg' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'fio' => $request['fio'],
            'login' => $request['loginReg'],
            'email' => $request['email'],
            'password' => Hash::make($request['passwordReg']),
        ]);
        Auth::login($user);
        return redirect()->route('profile')->with('success', 'Вы успешно зарегистрировались. Вход выполнен');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
