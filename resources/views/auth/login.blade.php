<x-layout title="JC Storage - Login">
  <div class="mt-10 flex justify-center">
    <div class="bg-white/5 p-8 rounded-lg max-w-md w-full">
      <h2 class="text-2xl font-semibold mb-6 text-white">Entrar na sua conta</h2>
      <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf
        <div>
          <label for="email" class="block text-sm font-medium text-white">Email</label>
          <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
            class="mt-1 block w-full px-3 py-2 bg-white/10 border border-white/20 rounded-md text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
          @error('email')
            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
          @enderror
        </div>
        <div>
          <label for="password" class="block text-sm font-medium text-white">Senha</label>
          <input id="password" type="password" name="password" required
            class="mt-1 block w-full px-3 py-2 bg-white/10 border border-white/20 rounded-md text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>
        <div>
          <button type="submit"
            class="w-full py-2 px-4 bg-blue-600 hover:bg-blue-700 rounded-md text-white font-semibold">
            Entrar
          </button>
        </div>
      </form>
      <p class="mt-4 text-sm text-center text-neutral-400">
        Não tem uma conta? <a href="{{ route('register') }}" class="text-blue-400 hover:underline">Criar conta</a>
      </p>
    </div>
  </div>
</x-layout>
