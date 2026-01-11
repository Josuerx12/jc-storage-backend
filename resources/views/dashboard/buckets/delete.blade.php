<x-layout title="JC Storage - Deletar Bucket">
  <div class="max-w-7xl mx-auto px-6 py-12">
    <x-back-button />

    <h2 class="text-3xl font-bold text-center text-white">
      Deletar Bucket
    </h2>

    <i class="mt-6 text-red-400 text-9xl w-32 h-32 mx-auto" data-lucide="alert-triangle"></i>

    <p class="mt-2 text-white/60 text-start md:text-center">
      Tem certeza que deseja deletar o bucket <b>"{{ $bucket->name }}"</b>? Esta ação é irreversível e todos os dados
      contidos
      nele serão perdidos.
    </p>

    <form action="{{ route('buckets.destroy', $bucket) }}" method="POST" class="mt-6">
      @csrf
      @method('DELETE')

      <div class="flex gap-4 mx-auto justify-center">
        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors">
          Deletar Bucket
        </button>
        <a href="{{ route('dashboard.buckets') }}"
          class="px-4 py-2 bg-gray-700 text-white rounded-md hover:bg-gray-600 transition-colors">Cancelar</a>
      </div>
    </form>
  </div>
</x-layout>
