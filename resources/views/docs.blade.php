<x-layout title="Documentação da API">
  <div class="flex items-center justify-center">
    <div class="max-w-4xl w-full px-4 sm:px-6 py-8 sm:py-16">

      <div class="text-center">
        <h1 class="text-3xl sm:text-4xl font-bold mb-4 sm:mb-6">
          Documentação da API
        </h1>

        <p class="text-base sm:text-lg text-white leading-relaxed">
          Guia completo para integração com a API de armazenamento de arquivos.
        </p>
      </div>

      <!-- Autenticação -->
      <div class="mt-8 sm:mt-12 rounded-lg border border-gray-200 bg-white p-4 sm:p-8 shadow-sm">
        <div class="flex items-center gap-3 mb-4">
          <span class="inline-flex items-center rounded-full bg-indigo-50 px-3 py-1 text-sm font-medium text-indigo-700">
            Passo 1
          </span>
        </div>

        <h2 class="text-lg sm:text-xl text-gray-900 font-semibold mb-2">
          Criando Credenciais de Acesso
        </h2>

        <p class="text-gray-600 leading-relaxed text-sm sm:text-base">
          Para utilizar a API, você precisa criar credenciais de acesso no painel do sistema.
          Após o login, acesse a seção de <strong>Credenciais</strong> e crie uma nova chave de acesso.
        </p>

        <p class="mt-4 text-gray-600 leading-relaxed text-sm sm:text-base">
          Você receberá duas chaves:
        </p>

        <ul class="mt-2 space-y-2 text-gray-600 text-sm sm:text-base">
          <li class="flex items-start gap-2">
            <span class="text-indigo-600 font-semibold">•</span>
            <span><strong>access_key</strong>: Identificador público da sua credencial</span>
          </li>
          <li class="flex items-start gap-2">
            <span class="text-indigo-600 font-semibold">•</span>
            <span><strong>secret_key</strong>: Chave secreta para autenticação (guarde com segurança)</span>
          </li>
        </ul>

        <div class="mt-4 p-3 sm:p-4 bg-amber-50 border border-amber-200 rounded-lg">
          <p class="text-amber-800 text-xs sm:text-sm">
            <strong>⚠️ Importante:</strong> A <code class="bg-amber-100 px-1 rounded">secret_key</code> é exibida apenas
            uma vez. Guarde-a em local seguro.
          </p>
        </div>
      </div>

      <!-- Headers -->
      <div class="mt-6 sm:mt-8 rounded-lg border border-gray-200 bg-white p-4 sm:p-8 shadow-sm">
        <div class="flex items-center gap-3 mb-4">
          <span
            class="inline-flex items-center rounded-full bg-indigo-50 px-3 py-1 text-sm font-medium text-indigo-700">
            Passo 2
          </span>
        </div>

        <h2 class="text-lg sm:text-xl text-gray-900 font-semibold mb-2">
          Autenticação nas Requisições
        </h2>

        <p class="text-gray-600 leading-relaxed text-sm sm:text-base">
          Todas as requisições à API devem incluir as credenciais nos headers HTTP:
        </p>

        <div class="mt-4 bg-gray-900 rounded-lg p-3 sm:p-4 overflow-x-auto">
          <pre
            class="text-green-400 text-xs sm:text-sm font-mono whitespace-pre-wrap break-all sm:whitespace-pre sm:break-normal">access_key: sua_access_key_aqui
secret_key: sua_secret_key_aqui
Content-Type: multipart/form-data</pre>
        </div>
      </div>

      <!-- Endpoints -->
      <div class="mt-6 sm:mt-8 rounded-lg border border-gray-200 bg-white p-4 sm:p-8 shadow-sm">
        <div class="flex items-center gap-3 mb-4">
          <span
            class="inline-flex items-center rounded-full bg-indigo-50 px-3 py-1 text-sm font-medium text-indigo-700">
            Passo 3
          </span>
        </div>

        <h2 class="text-lg sm:text-xl text-gray-900 font-semibold mb-4">
          Endpoints Disponíveis
        </h2>

        <!-- Upload -->
        <div class="border border-gray-100 rounded-lg p-3 sm:p-4 mb-4 bg-gray-50">
          <div class="flex flex-wrap items-center gap-2 mb-3">
            <span class="inline-flex items-center rounded bg-green-100 px-2 py-1 text-xs font-bold text-green-700">
              POST
            </span>
            <code class="text-xs sm:text-sm text-gray-800 break-all">/api/upload</code>
          </div>

          <p class="text-gray-600 text-sm mb-3">Faz upload de um arquivo para um bucket.</p>

          <div class="text-sm text-gray-700">
            <p class="font-semibold mb-2">Parâmetros (form-data):</p>
            <ul class="space-y-1 text-xs sm:text-sm">
              <li><code class="bg-gray-200 px-1 rounded">file</code> <span class="text-red-500">*</span> - Arquivo a ser
                enviado</li>
              <li><code class="bg-gray-200 px-1 rounded">bucket</code> <span class="text-red-500">*</span> - Nome do
                bucket de destino</li>
              <li><code class="bg-gray-200 px-1 rounded">filename</code> - Nome personalizado para o arquivo (opcional)
              </li>
              <li><code class="bg-gray-200 px-1 rounded">isPrivate</code> - "true" ou "false" (opcional, padrão: false)
              </li>
            </ul>
          </div>

          <div class="mt-4">
            <p class="font-semibold text-gray-700 text-sm mb-2">Exemplo com cURL:</p>
            <div class="bg-gray-900 rounded-lg p-3 overflow-x-auto">
              <pre class="text-green-400 text-xs font-mono whitespace-pre-wrap break-all sm:whitespace-pre sm:break-normal">curl -X POST {{ url('/api/upload') }} \
  -H "access_key: sua_access_key" \
  -H "secret_key: sua_secret_key" \
  -F "file=@/caminho/do/arquivo.pdf" \
  -F "bucket=meu-bucket" \
  -F "isPrivate=false"</pre>
            </div>
          </div>

          <div class="mt-4">
            <p class="font-semibold text-gray-700 text-sm mb-2">Resposta de sucesso (201):</p>
            <div class="bg-gray-900 rounded-lg p-3 overflow-x-auto">
              <pre class="text-green-400 text-xs font-mono whitespace-pre-wrap break-all sm:whitespace-pre sm:break-normal">{
  "message": "Arquivo salvo com sucesso!",
  "file": {
    "id": "uuid-do-arquivo",
    "filename": "arquivo.pdf",
    "is_private": false,
    "path": "meu-bucket/arquivo.pdf",
    "size": 102400,
    "mime_type": "application/pdf"
  },
  "url": "https://seu-dominio.com/files/uuid/download"
}</pre>
            </div>
          </div>
        </div>

        <!-- Generate Signed URL -->
        <div class="border border-gray-100 rounded-lg p-3 sm:p-4 mb-4 bg-gray-50">
          <div class="flex flex-wrap items-center gap-2 mb-3">
            <span class="inline-flex items-center rounded bg-green-100 px-2 py-1 text-xs font-bold text-green-700">
              POST
            </span>
            <code class="text-xs sm:text-sm text-gray-800 break-all">/api/files/{'{file}'}/generate-signed-url</code>
          </div>

          <p class="text-gray-600 text-sm mb-3">Gera uma URL temporária assinada para download de arquivos privados.</p>

          <div class="text-sm text-gray-700">
            <p class="font-semibold mb-2">Parâmetros (query string):</p>
            <ul class="space-y-1 text-xs sm:text-sm">
              <li><code class="bg-gray-200 px-1 rounded">expires_in</code> - Tempo em segundos até expirar (opcional,
                padrão: 600)</li>
            </ul>
          </div>

          <div class="mt-4">
            <p class="font-semibold text-gray-700 text-sm mb-2">Exemplo com cURL:</p>
            <div class="bg-gray-900 rounded-lg p-3 overflow-x-auto">
              <pre class="text-green-400 text-xs font-mono whitespace-pre-wrap break-all sm:whitespace-pre sm:break-normal">curl -X POST "{{ url('/api/files') }}/uuid-do-arquivo/generate-signed-url?expires_in=3600" \
  -H "access_key: sua_access_key" \
  -H "secret_key: sua_secret_key"</pre>
            </div>
          </div>

          <div class="mt-4">
            <p class="font-semibold text-gray-700 text-sm mb-2">Resposta de sucesso (200):</p>
            <div class="bg-gray-900 rounded-lg p-3 overflow-x-auto">
              <pre class="text-green-400 text-xs font-mono whitespace-pre-wrap break-all sm:whitespace-pre sm:break-normal">{
  "url": "https://seu-dominio.com/files/uuid/download?signature=...",
  "expires_at": "2026-01-14 15:30:00"
}</pre>
            </div>
          </div>
        </div>

        <!-- Delete -->
        <div class="border border-gray-100 rounded-lg p-3 sm:p-4 bg-gray-50">
          <div class="flex flex-wrap items-center gap-2 mb-3">
            <span class="inline-flex items-center rounded bg-red-100 px-2 py-1 text-xs font-bold text-red-700">
              DELETE
            </span>
            <code class="text-xs sm:text-sm text-gray-800 break-all">/api/files/{'{file}'}</code>
          </div>

          <p class="text-gray-600 text-sm mb-3">Remove um arquivo permanentemente.</p>

          <div class="mt-4">
            <p class="font-semibold text-gray-700 text-sm mb-2">Exemplo com cURL:</p>
            <div class="bg-gray-900 rounded-lg p-3 overflow-x-auto">
              <pre class="text-green-400 text-xs font-mono whitespace-pre-wrap break-all sm:whitespace-pre sm:break-normal">curl -X DELETE "{{ url('/api/files') }}/uuid-do-arquivo" \
  -H "access_key: sua_access_key" \
  -H "secret_key: sua_secret_key"</pre>
            </div>
          </div>

          <div class="mt-4">
            <p class="font-semibold text-gray-700 text-sm mb-2">Resposta de sucesso (200):</p>
            <div class="bg-gray-900 rounded-lg p-3 overflow-x-auto">
              <pre class="text-green-400 text-xs font-mono whitespace-pre-wrap break-all sm:whitespace-pre sm:break-normal">{
  "message": "Arquivo deletado com sucesso!"
}</pre>
            </div>
          </div>
        </div>
      </div>

      <!-- Códigos de Erro -->
      <div class="mt-6 sm:mt-8 rounded-lg border border-gray-200 bg-white p-4 sm:p-8 shadow-sm">
        <h2 class="text-lg sm:text-xl text-gray-900 font-semibold mb-4">
          Códigos de Resposta
        </h2>

        <div class="overflow-x-auto">
          <table class="w-full text-xs sm:text-sm">
            <thead>
              <tr class="border-b border-gray-200">
                <th class="text-left py-2 pr-4 text-gray-700 font-semibold">Código</th>
                <th class="text-left py-2 text-gray-700 font-semibold">Descrição</th>
              </tr>
            </thead>
            <tbody class="text-gray-600">
              <tr class="border-b border-gray-100">
                <td class="py-2 pr-4"><span
                    class="bg-green-100 text-green-700 px-2 py-0.5 rounded text-xs font-medium">200</span></td>
                <td class="py-2">Requisição bem-sucedida</td>
              </tr>
              <tr class="border-b border-gray-100">
                <td class="py-2 pr-4"><span
                    class="bg-green-100 text-green-700 px-2 py-0.5 rounded text-xs font-medium">201</span></td>
                <td class="py-2">Recurso criado com sucesso</td>
              </tr>
              <tr class="border-b border-gray-100">
                <td class="py-2 pr-4"><span
                    class="bg-red-100 text-red-700 px-2 py-0.5 rounded text-xs font-medium">401</span></td>
                <td class="py-2">Credenciais inválidas ou ausentes</td>
              </tr>
              <tr class="border-b border-gray-100">
                <td class="py-2 pr-4"><span
                    class="bg-red-100 text-red-700 px-2 py-0.5 rounded text-xs font-medium">403</span></td>
                <td class="py-2">Acesso não autorizado ao recurso</td>
              </tr>
              <tr class="border-b border-gray-100">
                <td class="py-2 pr-4"><span
                    class="bg-red-100 text-red-700 px-2 py-0.5 rounded text-xs font-medium">404</span></td>
                <td class="py-2">Recurso não encontrado</td>
              </tr>
              <tr>
                <td class="py-2 pr-4"><span
                    class="bg-red-100 text-red-700 px-2 py-0.5 rounded text-xs font-medium">422</span></td>
                <td class="py-2">Dados de entrada inválidos</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Suporte -->
      <div class="mt-6 sm:mt-8 rounded-lg border border-gray-200 bg-white p-4 sm:p-8 shadow-sm">
        <h2 class="text-lg sm:text-xl text-gray-900 font-semibold mb-2">
          Precisa de Ajuda?
        </h2>

        <p class="text-gray-600 leading-relaxed text-sm sm:text-base">
          Caso tenha dúvidas ou precise de suporte adicional, entre em contato com o responsável técnico pelo sistema.
        </p>
      </div>

      <div class="mt-8 sm:mt-12 text-center text-sm text-gray-500">
        © {{ date('Y') }} • Todos os direitos reservados
      </div>

    </div>
  </div>
</x-layout>
