<x-layout title="JC Storage - Dashboard">
  <main class="max-w-7xl mx-auto px-6 py-12">
    <div class="flex items-center justify-between mb-8">
      <h1 class="text-3xl font-bold text-white">Dashboard</h1>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="px-4 py-2 bg-white/10 hover:bg-white/20 rounded-md text-white transition">
          Sair
        </button>
      </form>
    </div>

    <div class="bg-white/5 border border-white/10 rounded-lg p-6">
      <p class="text-white">Olá, <strong>{{ auth()->user()->name }}</strong>!</p>
      <p class="text-neutral-400 mt-2">Bem-vindo ao seu painel de controle.</p>
    </div>
  </main>
</x-layout>
