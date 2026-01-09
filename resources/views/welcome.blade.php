<x-layout title="JC Storage - Pagina Inicial">
  <section class="max-w-7xl mx-auto px-6 py-4 text-center">
    <p class="text-sm text-neutral-500 mb-2">Status atual</p>
    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-green-500/10 text-green-400">
      <span class="w-2 h-2 rounded-full bg-green-400"></span>
      API operacional
    </div>
  </section>

  <section class="max-w-7xl mx-auto px-6 py-14 text-center">
    <h1 class="text-4xl md:text-6xl font-bold mb-6">
      Armazenamento de arquivos
      <span class="text-neutral-400 block">simples, seguro e escalável</span>
    </h1>

    <p class="text-neutral-400 max-w-2xl mx-auto mb-10">
      O <strong class="text-white">JC Storage API</strong> é uma solução moderna para upload,
      download e gerenciamento de arquivos via API e Client,
      com foco em performance, segurança e simplicidade.
    </p>

    <div class="flex flex-col sm:flex-row gap-4 justify-center">
      <a href="/docs" class="px-6 py-3 rounded-lg bg-white text-black font-medium hover:bg-neutral-200 transition">
        Ver documentação
      </a>

      <a href="/api/health" class="px-6 py-3 rounded-lg border border-white/20 hover:border-white transition">
        Status da API
      </a>
    </div>
  </section>

  <!-- FEATURES -->
  <section id="features" class="bg-neutral-950 border-t border-white/10">
    <div class="max-w-7xl mx-auto px-6 py-20 grid grid-cols-1 md:grid-cols-2 gap-10">

      <div class="p-6 rounded-xl border border-white/10">
        <h3 class="text-lg font-semibold mb-2">Upload Seguro</h3>
        <p class="text-sm text-neutral-400">
          Upload de arquivos com validação, criptografia opcional
          e controle total de acesso.
        </p>
      </div>

      <div class="p-6 rounded-xl border border-white/10">
        <h3 class="text-lg font-semibold mb-2">Downloads Controlados</h3>
        <p class="text-sm text-neutral-400">
          Downloads temporários, URLs assinadas
          e streaming direto sem expor a origem.
        </p>
      </div>

    </div>
  </section>
</x-layout>
