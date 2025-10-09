@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>💬 Daftar Chat Masuk</h3>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>WA ID</th>
                <th>Sender</th>
                <th>Message</th>
                <th>Direction</th>
            </tr>
        </thead>
        <tbody>
            @foreach($chats as $chat)
                <tr>
                    <td>{{ $chat->wa_id }}</td>
                    <td>{{ $chat->sender }}</td>
                    <td>{{ $chat->message }}</td>
                    <td>{{ $chat->direction }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection