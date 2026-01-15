<x-layout title="JC Storage - Credenciais">
  <div class="max-w-7xl mx-auto px-6 py-12">
    <x-back-button url="{{ route('dashboard.credentials') }}" />

    <h2 class="text-2xl font-bold">Detalhes da credencial: {{ $credential->name }}</h2>
    <form class="mt-6 max-w-lg">
      @csrf

      <div class="mb-4">
        <label for="id" class="block text-white/80 mb-2">ID da Credencial</label>
        <input type="text" disabled name="id" id="id" required
          class="w-full px-4 py-2 bg-gray-800 border border-white/10 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
          placeholder="ID da credencial" value="{{ $credential->id }}">
      </div>

      <div class="mb-4">
        <label for="name" class="block text-white/80 mb-2">Nome da Credencial</label>
        <input type="text" disabled name="name" id="name" required
          class="w-full px-4 py-2 bg-gray-800 border border-white/10 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
          placeholder="Digite o nome da credencial" value="{{ $credential->name }}">
        @error('name')
          <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-4">
        <label for="access_key" class="block text-white/80 mb-2">Chave de Acesso</label>
        <input type="text" disabled name="access_key" id="access_key" required
          class="w-full px-4 py-2 bg-gray-800 border border-white/10 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
          placeholder="Digite o nome da credencial" value="{{ $credential->access_key }}">
        @error('access_key')
          <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- <button type="submit"
        class="px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors">Criar Bucket</button> --}}
    </form>
  </div>
</x-layout>
