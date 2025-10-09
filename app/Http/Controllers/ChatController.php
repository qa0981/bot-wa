<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Chat;
use App\Models\User;

class ChatController extends Controller
{
    // public function index()
    // {
    //     $chats = Chat::orderBy('created_at', 'desc')->get();
    //     return view('dashboard', compact('chats'));
    // }

    public function index()
    {
        $user = auth()->user();
        $chats = Chat::where('handled_by', $user->id)
                    ->select('wa_id')
                    ->distinct()
                    ->get();

        return view('dashboard', compact('chats'));
    }

    public function show($wa_id)
    {
        $chats = Chat::where('wa_id', $wa_id)->orderBy('created_at')->get();
        return view('chat-detail', compact('chats', 'wa_id'));
    }

    // public function store(Request $request)
    // {
    //     $chat = Chat::create([
    //         'wa_id' => $request->wa_id,
    //         'sender' => $request->sender ?? 'Pasien',
    //         'message' => $request->message ?? $request->pesan,
    //         'direction' => $request->direction ?? 'in'
    //     ]);

    //     return response()->json($chat, 201);
    // }

    public function store(Request $request)
    {
        // cari petugas online
        $petugas = User::where('is_online', true)
            ->inRandomOrder()
            ->first();

        $chat = Chat::create([
            'wa_id' => $request->wa_id,
            'sender' => $request->sender ?? 'Pasien',
            'message' => $request->message,
            'direction' => 'in',
            'handled_by' => $petugas?->id
        ]);

        return response()->json($chat, 201);
    }

    // public function reply(Request $request)
    // {
    //     $validated = $request->validate([
    //         'wa_id' => 'required|string',
    //         'message' => 'required|string',
    //     ]);

    //     Chat::create([
    //         'wa_id' => $validated['wa_id'],
    //         'sender' => 'Petugas',
    //         'message' => $validated['message'],
    //         'direction' => 'out',
    //     ]);

    //     $response = Http::post('http://127.0.0.1:5000/send', [
    //         'wa_id' => $validated['wa_id'],
    //         'message' => $validated['message'],
    //     ]);

    //     return response()->json([
    //         'status' => $response->successful() ? 'success' : 'error',
    //         'response' => $response->json()
    //     ]);
    // }

    public function reply(Request $request)
    {
        $validated = $request->validate([
            'wa_id' => 'required|string',
            'message' => 'required|string',
        ]);

        $user = auth()->user();

        Chat::create([
            'wa_id' => $validated['wa_id'],
            'sender' => $user->name,
            'message' => $validated['message'],
            'direction' => 'out',
            'handled_by' => $user->id
        ]);

        $response = Http::post('http://127.0.0.1:5000/send', [
            'wa_id' => $validated['wa_id'],
            'message' => $validated['message'],
        ]);

        return response()->json([
            'status' => $response->successful() ? 'success' : 'error',
            'response' => $response->json()
        ]);
    }

    public function getData()
    {
        $chats = Chat::orderBy('created_at', 'desc')->get();
        return response()->json($chats);
    }
}
