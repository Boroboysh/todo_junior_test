<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // Аутентификация пользователя
    public function authenticate(Request $request)
    {
        $data = $request->only('email', 'password');

        $validator = Validator::make($data, [
            'email' => 'required|email:rfc,dns',
            'password' => 'required|string|min:6|max:50',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator);
        }

        $credentials = $request->validate([
            'email' => ['required', 'email:rfc,dns'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // Регистрация
    public function register(Request $request)
    {
        $data = $request->only('name', 'email', 'password');

        $validator = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email:rfc,dns',
            'password' => 'required|string|min:6|max:50',
        ]);

        if ($validator->fails()) {
            return redirect('register')
                ->withErrors($validator);
        }

        $user = User::where('email', $request->input('email'))->first();

        if (!$user) {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            return redirect('login');
        }

        $validator->errors()->add('user', 'Пользователь с такой почтой уже существует');

        return redirect('register')
            ->withErrors($validator);
    }

    // Выход из учётной записи
    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
