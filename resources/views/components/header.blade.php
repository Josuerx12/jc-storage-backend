<header x-data="navbar" class="border-b border-white/10">
  <div class="max-w-7xl mx-auto px-6 py-6 flex items-center justify-between">
    <a href="/" class="flex items-center gap-3">
      <div class="w-10 h-10 rounded-lg bg-white text-black flex items-center justify-center font-bold">
        JC
      </div>
      <span class="text-lg font-semibold">Storage</span>
    </a>

    <nav class="hidden md:flex items-center gap-6 text-sm text-neutral-300">
      <a href="/docs" class="hover:text-white transition">Documentação</a>
      @auth
        <a href="/dashboard">
          Dashboard
        </a>
      @endauth
      @guest
        <a href="/login" class="hover:text-white transition">Entrar</a>
        <a href="/register" class="px-4 py-2 bg-white/10 hover:bg-white/20 rounded-md transition">
          Criar Conta
        </a>
      @endguest
    </nav>

    <nav x-bind:class="open ? 'top-20 opacity-100' : '-top-full opacity-0'"
      class="flex flex-col md:hidden duration-500 ease-linear absolute left-0 w-full bg-black/90 border-t border-white/10 py-4">
      <a href="/docs" class="block px-6 py-2 hover:bg-white/10 transition">Documentação</a>
      @auth
        <a href="/dashboard" class="block px-6 py-2 hover:bg-white/10 transition">
          Dashboard
        </a>
      @endauth
      @guest
        <a href="/login" class="block px-6 py-2 hover:bg-white/10 transition">Entrar</a>
        <a href="/register" class="block px-6 py-2 hover:bg-white/10 transition">
          Criar Conta
        </a>
      @endguest

    </nav>

    <button @click="toggle" class="md:hidden cursor-pointer focus:outline-none">
      <i data-lucide="menu" class="text-2xl text-white"></i>
    </button>
  </div>
</header>
