<x-layout title="JC Storage - Arquivos do Bucket">
  <div class="max-w-7xl mx-auto px-6 py-12">
    <x-back-button url="{{ route('dashboard.buckets.show', $bucket) }}" />

    <h2>
      Arquivos do Bucket: {{ $bucket->name }}
    </h2>

    <div class="w-full mr-0 flex justify-end items-center gap-4 mt-6">
      <a class="border hover:bg-gray-800 duration-200 border-gray-50 rounded-md px-3 py-2 flex items-center gap-2" ">
        Adicionar Arquivo <i data-lucide="plus-circle" class=""></i>
      </a>

      <button class="px-3 py-2 flex items-center gap-2 bg-blue-500 rounded-md">Filtrar <i
          data-lucide="filter"></i></button>
    </div>

    <p>
      Lista de arquivos armazenados no bucket " {{ $bucket->name }}". </p>
    </div>
</x-layout>
