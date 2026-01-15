<x-layout title="JC Storage - Arquivos do Bucket">
  <div class="max-w-7xl mx-auto px-6 py-12">
    <x-back-button url="{{ route('dashboard.buckets.show', $bucket) }}" />

    <h2 class="text-2xl font-bold">
      Arquivos do Bucket: {{ $bucket->name }}
    </h2>

    <div class="w-full mr-0 flex justify-end items-center gap-4 mt-6">
      <a class="border hover:bg-gray-800 duration-200 border-gray-50 rounded-md px-3 py-2 flex items-center gap-2" ">
        Adicionar Arquivo <i data-lucide="plus-circle" class=""></i>
      </a>

      <button class="px-3 py-2 flex items-center gap-2 bg-blue-500 rounded-md">Filtrar <i
          data-lucide="filter"></i></button>
    </div>

               @if ($files->isNotEmpty())
        <div class="mt-6 w-full overflow-x-auto">
          <table class="w-full table-auto border-collapse">
            <thead>
              <tr>
                <th class="text-left text-white/60 p-4">Nome do Arquivo</th>
                <th class="text-left text-white/60 p-4">Tamanho</th>
                <th class="text-left text-white/60 p-4">Tipo</th>
                <th class="text-left text-white/60 p-4">Data de Upload</th>
                <th class="text-left text-white/60 p-4">Ações</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($files as $file)
                <tr class="border-t border-white/10 hover:bg-white/5 transition-colors">
                  <td class="p-4 text-white/80">{{ $file->filename }}</td>
                  <td class="p-4 text-white/80">{{ number_format($file->size / 1024, 2) }} KB</td>
                  <td class="p-4 text-white/80">{{ $file->mime_type }}</td>
                  <td class="p-4 text-white/80">{{ $file->created_at->format('d/m/Y H:i') }}</td>
                  <td class="p-4 text-white/80">
                    <a href="{{ route('files.public.download', ['id' => $file->id]) }}"
                      class="text-blue-500 hover:underline">Download</a>
                    |
                    <a href="{{ route('dashboard.buckets.files.delete', [$bucket, $file]) }}"
                      class="text-red-500 hover:underline">Excluir</a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>

          <div class="mt-4">
            {{ $files->links() }}
          </div>
        </div>
        @endif

        @if ($files->isEmpty())
          <p class="mt-6 text-center text-gray-400">Nenhum arquivo encontrado neste bucket.</p>
        @endif

</x-layout>
