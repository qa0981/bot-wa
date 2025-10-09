@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-semibold mb-4">Chat: {{ $wa_id }}</h2>

    <div class="bg-gray-100 p-4 rounded-lg h-96 overflow-y-auto mb-4">
        @foreach($chats as $chat)
            <div class="mb-2 {{ $chat->direction == 'out' ? 'text-right' : '' }}">
                <span class="px-3 py-2 inline-block rounded-lg 
                    {{ $chat->direction == 'out' ? 'bg-blue-500 text-white' : 'bg-white text-gray-800' }}">
                    {{ $chat->message }}
                </span>
            </div>
        @endforeach
    </div>

    <form onsubmit="return kirimBalasan(event)">
        <input type="hidden" id="wa_id" value="{{ $wa_id }}">
        <div class="flex gap-2">
            <input type="text" id="message" placeholder="Ketik pesan..." 
                   class="flex-1 border rounded p-2" required>
            <button class="bg-blue-600 text-white px-4 py-2 rounded">Kirim</button>
        </div>
    </form>
</div>

<script>
async function kirimBalasan(e) {
    e.preventDefault();
    const wa_id = document.getElementById('wa_id').value;
    const message = document.getElementById('message').value;

    const res = await fetch('/api/chat/reply', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ wa_id, message })
    });

    const data = await res.json();
    if (data.status === 'sent') location.reload();
    else alert('Gagal mengirim pesan!');
}
</script>
@endsection