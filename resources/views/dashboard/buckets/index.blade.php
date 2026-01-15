<x-layout title="JC Storage - Buckets">
  <div class="max-w-7xl mx-auto px-6 py-12">
    <x-back-button url="{{ route('dashboard') }}" />

    <h2 class="text-3xl font-bold text-white">
      Gerencie seus buckets
    </h2>
    <p class="mt-2 text-white/60">
      Crie, visualize e gerencie seus buckets de armazenamento com facilidade.
    </p>

    <div class="w-full mr-0 flex justify-end items-center gap-4 mt-6">
      <a class="border hover:bg-gray-800 duration-200 border-gray-50 rounded-md px-3 py-2 flex items-center gap-2"
        href="{{ route('dashboard.buckets.create') }}">
        Criar Novo Bucket <i data-lucide="plus-circle" class=""></i>
      </a>

      <button class="px-3 py-2 flex items-center gap-2 bg-blue-500 rounded-md">Filtrar <i
          data-lucide="filter"></i></button>
    </div>

    @if ($buckets->isEmpty())
      <p class="mt-6 ">
        Você ainda não possui buckets. Clique em <a href="{{ route('dashboard.buckets.create') }}"
          class="text-blue-400">criar novo bucket</a> para
        começar a armazenar seus
        arquivos.
      </p>
    @endif

    @if ($buckets->isNotEmpty())
      <div class="mt-6 w-full overflow-x-auto">
        <table class="w-full table-auto border-collapse">
          <thead>
            <tr>
              <th class="text-left text-white/60 p-4">ID</th>
              <th class="text-left text-white/60 p-4">Nome</th>
              <th class="text-left text-white/60 p-4">Data de Criação</th>
              <th class="text-left text-white/60 p-4">Ações</th>
            </tr>
          </thead>

          <tbody>
            @foreach ($buckets as $bucket)
              <tr class="border-t border-white/10 hover:bg-white/5 transition-colors">
                <td class="p-4 text-white/80">{{ $bucket->id }}</td>
                <td class="p-4 text-white/80">{{ $bucket->name }}</td>
                <td class="p-4 text-white/80">{{ $bucket->created_at->format('d/m/Y') }}</td>
                <td class="p-4 text-white/80 flex gap-4">
                  <a href="{{ route('dashboard.buckets.show', $bucket) }}" class="text-blue-400 hover:underline">Ver
                    Detalhes</a>
                  {{-- <a href="#" class="text-yellow-400 hover:underline">Editar</a> --}}

                  <a href="{{ route('dashboard.buckets.delete', $bucket) }}"
                    class="text-red-400 hover:underline">Excluir</a>

                </td>
              </tr>
            @endforeach
        </table>
      </div>
    @endif
  </div>
</x-layout>
