<x-layout title="JC Storage - Deletar Credencial">
  <div class="max-w-7xl mx-auto px-6 py-12">
    <x-back-button url="{{ route('dashboard.credentials') }}" />

    <h2 class="text-3xl font-bold text-center text-white">
      Deletar credencial
    </h2>

    <i class="mt-6 text-red-400 text-9xl w-32 h-32 mx-auto" data-lucide="alert-triangle"></i>

    <p class="mt-2 text-white/60 text-start md:text-center">
      Tem certeza que deseja deletar a credencial <b>"{{ $credential->name }}"</b>? Esta ação é irreversível e não será
      possivel mais acessar a api com esta credencial.
    </p>

    <form action="{{ route('credentials.destroy', $credential) }}" method="POST" class="mt-6">
      @csrf
      @method('DELETE')

      <div class="flex gap-4 mx-auto justify-center">
        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors">
          Deletar Credencial
        </button>
        <a href="{{ route('dashboard.credentials') }}"
          class="px-4 py-2 bg-gray-700 text-white rounded-md hover:bg-gray-600 transition-colors">Cancelar</a>
      </div>
    </form>
  </div>
</x-layout>
