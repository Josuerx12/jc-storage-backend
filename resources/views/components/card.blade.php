<div
  class="group relative bg-linear-to-br from-white/10 to-white/5 border border-white/10 rounded-2xl p-6 min-w-44 grow backdrop-blur-sm shadow-lg hover:shadow-xl hover:border-white/20 transition-all flex justify-center flex-col items-center duration-300">

  <div class="flex gap-4 justify-start w-full items-baseline">
    {{-- Ícone com fundo --}}
    <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-blue-500/20 text-blue-400 mb-4">
      <i data-lucide="{{ $lucideIconName }}" class="w-6 h-6"></i>
    </div>

    {{-- Título --}}
    <h2 class="text-sm font-medium text-white/60 uppercase tracking-wide mb-1">{{ $title }}</h2>
  </div>


  {{-- Valor --}}
  <div class="text-4xl font-bold text-white mb-4">
    {{ $value }}
  </div>

  {{-- Botão --}}
  @if ($buttonText && $buttonLink)
    <a href="{{ $buttonLink }}"
      class="inline-flex items-center gap-1 text-sm font-medium text-blue-400 hover:text-blue-300 transition-colors group/link">
      {{ $buttonText }}
      <i data-lucide="arrow-right" class="w-4 h-4 group-hover/link:translate-x-1 transition-transform"></i>
    </a>
  @endif
</div>
