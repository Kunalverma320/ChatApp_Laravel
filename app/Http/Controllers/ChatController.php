<?php

namespace App\Http\Controllers;

use App\Events\chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function usersave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'error' => $validator->errors(),
            ]);
        }
        return response()->json([
            'status' => 200,
            'message' => 'User Submited Successfully',
            'username' => $request->username,
        ]);
    }

    public function chat(Request $request)
    {
        $username = $request->query('username');
        if($username)
        {
            return view('chat', compact('username'));
        }
        else
        {
            return redirect()->route('home')->with('error', 'Please enter your username.');
        }

    }

    public function brodmsg(Request $request)
    {

        event(new chat($request->username, $request->message));
        return response()->json([
            'username' => $request->username,
            'message' => $request->message,
        ]);
    }
}
