<x-app-layout>
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-semibold mb-4">Daftar Chat Aktif</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($chats as $chat)
                <a href="/dashboard/{{ $chat->wa_id }}" 
                   class="p-4 bg-white rounded-lg shadow hover:bg-blue-50 block">
                   <h3 class="text-lg font-bold">{{ $chat->wa_id }}</h3>
                   <p class="text-gray-500">Klik untuk lihat percakapan</p>
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>
