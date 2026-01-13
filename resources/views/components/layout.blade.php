<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ $title }}</title>
  <meta name="description" content="JC Storage - Armazenamento em Nuvem Simples e Seguro">
  <meta name="author" content="JC Dev">
  <meta name="keywords" content="armazenamento em nuvem, arquivos, segurança, backup, JC Storage">

  <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

  @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  @endif
</head>

<body>
  <main class="min-h-screen bg-linear-to-b from-black to-neutral-900 text-white flex flex-col">
    <x-header />

    <div class="flex-1">
      {{ $slot }}
    </div>

    <x-footer />
  </main>

  <script src="https://unpkg.com/lucide@latest"></script>
  <script>
    lucide.createIcons();
  </script>
</body>

</html>
