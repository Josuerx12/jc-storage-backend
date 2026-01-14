<x-layout title="JC Storage - Dashboard">
  <main class="max-w-7xl mx-auto px-6 py-12">
    <div class="flex items-center mb-8">
      <h1 class="text-3xl font-bold text-white">Dashboard</h1>

    </div>

    <div class="bg-white/5 border border-white/10 rounded-lg p-6">
      <p class="text-white">Olá, <strong>{{ auth()->user()->name }}</strong>!</p>
      <p class="text-neutral-400 mt-2">Bem-vindo ao seu painel de controle.</p>

      <div class="flex flex-wrap mt-10 gap-4 justify-between">
        <x-card title="Buckets Ativos" value="{{ $buckets->count() }}" lucideIconName="paint-bucket"
          buttonText="Ver Buckets" buttonLink="/dashboard/buckets" />
        <x-card title="Credenciais Ativas" value="{{ $credentials->count() }}" lucideIconName="key"
          buttonText="Ver Credenciais" buttonLink="/dashboard/credentials" />
        <x-card title="Total de Arquivos" value="{{ $filesCount }}" lucideIconName="folder" />
      </div>
    </div>
  </main>
</x-layout>
