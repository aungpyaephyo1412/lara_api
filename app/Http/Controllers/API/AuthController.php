<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            "name" => "required|min:4|max:20",
            "email" => "required|email|unique:students,email",
            "password" => "required|min:8",
            "password_confirmation" => "required|same:password"
        ]);
        $student = new User();
        $student->name = $request->name;
        $student->email = $request->email;
        $student->password = Hash::make($request->password);
        $student->save();
        return redirect()->route("auth.login")->with("message", "Register successful!");
    }

    public function login(Request $request)
    {
        $request->validate([
            "email" => "required|email|exists:students,email",
            "password" => "required|min:8",
        ], [
            "email.exists" => "Something went wrong!"
        ]);
        $student = User::where("email", $request->email)->first();
        if (!Hash::check($request->password, $student->password)) {
            return redirect()->route("auth.login")->withErrors(["email" => "Something went wrong!"]);
        }
        session(["auth" => $student]);
        return redirect()->route("dashboard.home");
    }
}
