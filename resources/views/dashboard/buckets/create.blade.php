<x-layout title="JC Storage - Criar Novo Bucket">
  <div class="max-w-7xl mx-auto px-6 py-12">
    <x-back-button url="{{ route('dashboard.buckets') }}" />
    <h2 class="text-3xl font-bold text-white">
      Criar Novo Bucket
    </h2>
    <p class="mt-2 text-white/60">
      Preencha o formulário abaixo para criar um novo bucket de armazenamento.
    </p>

    <form action="{{ route('buckets.store') }}" method="POST" class="mt-6 max-w-lg">
      @csrf

      <div class="mb-4">
        <label for="name" class="block text-white/80 mb-2">Nome do Bucket</label>
        <input type="text" name="name" id="name" required
          class="w-full px-4 py-2 bg-gray-800 border border-white/10 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
          placeholder="Digite o nome do bucket" value="{{ old('name') }}">
        @error('name')
          <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <button type="submit"
        class="px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors">Criar Bucket</button>
    </form>
  </div>
</x-layout>
