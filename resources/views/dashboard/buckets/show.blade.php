<x-layout title="JC Storage - Buckets">
  <div class="max-w-7xl mx-auto px-6 py-12">
    <x-back-button url="{{ route('dashboard.buckets') }}" />

    <h2 class="text-2xl font-bold">Detalhes do Bucket: {{ $bucket->name }}</h2>

    <form class="mt-6 max-w-lg">
      @csrf

      <div class="mb-4">
        <label for="id" class="block text-white/80 mb-2">ID do Bucket</label>
        <input type="text" disabled name="id" id="id" required
          class="w-full px-4 py-2 bg-gray-800 border border-white/10 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
          placeholder="ID do bucket" value="{{ $bucket->id }}">
      </div>

      <div class="mb-4">
        <label for="name" class="block text-white/80 mb-2">Nome do Bucket</label>
        <input type="text" disabled name="name" id="name" required
          class="w-full px-4 py-2 bg-gray-800 border border-white/10 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
          placeholder="Digite o nome do bucket" value="{{ $bucket->name }}">
        @error('name')
          <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- <button type="submit"
        class="px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors">Criar Bucket</button> --}}
    </form>

    <div class="mt-8">
      <a href="{{ route('dashboard.buckets.files', $bucket) }}"
        class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition-colors">Ver Arquivos do
        Bucket</a>
    </div>
  </div>
</x-layout>
