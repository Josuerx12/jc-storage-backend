<x-layout title="JC Storage - Credenciais">
  <div x-data="credentialForm" class="max-w-7xl mx-auto px-6 py-12">
    <x-back-button url="{{ route('dashboard.credentials') }}" />

    <h2 class="text-3xl font-bold text-white">
      Criar nova credencial
    </h2>

    <form action="{{ route('dashboard.credentials.store') }}" method="POST" class="mt-8 space-y-6">
      @csrf

      <!-- Nome -->
      <div>
        <label class="block text-white/80 mb-2">Nome da Credencial</label>
        <input type="text" name="name" required
          class="w-full px-4 py-2 bg-gray-800 border border-white/10 rounded-md text-white" />
      </div>

      <div class="flex gap-2 flex-wrap">
        <!-- Access Key -->
        <div class="grow">
          <label class="block text-white/80 mb-2">Access Key</label>
          <input type="text" name="access_key" x-model="accessKey" readonly
            class="w-full px-4 py-2 bg-gray-800 border border-white/10 rounded-md text-white cursor-not-allowed"
            placeholder="Gere suas credenciais" />
        </div>

        <!-- Secret Key -->
        <div class="grow">
          <label class="block text-white/80 mb-2">Secret Key</label>
          <div class="flex gap-2">
            <input :type="isSecretKeyVisible ? 'text' : 'password'" name="secret_key" x-model="secretKey" readonly
              class="w-full px-4 py-2 bg-gray-800 border border-white/10 rounded-md text-white cursor-not-allowed"
              placeholder="Gere suas credenciais" />

            <button x-show="accessKey && secretKey" title="Mostrar/Esconder secret key" type="button"
              class="text-white" @click="toggleSecretKeyVisibility">
              <i x-show="!isSecretKeyVisible" data-lucide="eye"></i>
              <i x-show="isSecretKeyVisible" data-lucide="eye-off"></i>
            </button>
          </div>
        </div>
      </div>

      <p x-show="accessKey && secretKey" class="text-sm text-white/70">
        Após gerar as credenciais, certifique-se de copiá-las e armazená-las em um local seguro. Você não poderá
        visualizar a Secret Key novamente após sair desta página.
      </p>

      <!-- Botões -->
      <div class="flex gap-4">
        <button x-show="!accessKey && !secretKey" type="button" @click="generateCredentials"
          class="px-4 py-2 cursor-pointer bg-green-600 hover:bg-green-700 rounded-md text-white">
          Gerar Credenciais
        </button>

        <button type="submit" x-show="accessKey && secretKey"
          class="px-4 py-2 cursor-pointer bg-blue-600 hover:bg-blue-700 rounded-md text-white">
          Salvar
        </button>
      </div>
    </form>
  </div>
</x-layout>
