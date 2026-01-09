<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Documentação da API</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gradient-to-b from-black to-neutral-900 text-white">
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-3xl w-full px-6 py-16">

            <div class="text-center">
                <h1 class="text-4xl font-bold mb-6">
                    Documentação da API
                </h1>

                <p class="text-lg text-white leading-relaxed">
                    Esta API foi desenvolvida para suportar integrações específicas da
                    plataforma. No momento, a documentação pública ainda está em
                    processo de organização.
                </p>
            </div>

            <div class="mt-12 rounded-lg border border-gray-200 bg-white p-8 shadow-sm">
                <div class="flex items-center gap-3 mb-4">
                    <span class="inline-flex items-center rounded-full bg-indigo-50 px-3 py-1 text-sm font-medium text-indigo-700">
                        Em breve
                    </span>
                </div>

                <h2 class="text-xl text-gray-900 font-semibold mb-2">
                    Novidades em construção
                </h2>

                <p class="text-gray-600 leading-relaxed">
                    Estamos preparando uma documentação completa, com exemplos de uso,
                    fluxos de autenticação e boas práticas para consumo da API.
                </p>

                <p class="mt-4 text-gray-600 leading-relaxed">
                    Caso precise de acesso antecipado ou informações adicionais,
                    entre em contato com o responsável técnico pelo sistema.
                </p>
            </div>

            <div class="mt-12 text-center text-sm text-gray-500">
                © {{ date('Y') }} • Todos os direitos reservados
            </div>

        </div>
    </div>
</body>
</html>
