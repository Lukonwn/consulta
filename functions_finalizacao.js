
async function showComprovante() {
    try {
        const step14 = document.getElementById('step14') || document.body;
        const container =
            step14.querySelector('.relative') ||
            step14.querySelector('[data-comprovante-container]') ||
            step14;

        let skeleton = document.getElementById('comprovanteSkeleton');
        if (!skeleton) {
            skeleton = document.createElement('div');
            skeleton.id = 'comprovanteSkeleton';
            skeleton.className = 'w-full h-64 bg-gray-200 animate-pulse rounded-xl';
            container.appendChild(skeleton);
        }
        skeleton.classList.remove('hidden');

        let img = document.getElementById('comprovanteImg');
        if (!img) {
            img = document.createElement('img');
            img.id = 'comprovanteImg';
            img.className = 'hidden w-full h-auto rounded-lg shadow-sm';
            img.alt = 'Gerando comprovante...';
            container.appendChild(img);
        }
        img.classList.add('hidden');
        img.removeAttribute('src');

        const oldWarn = document.getElementById('comprovanteError');
        if (oldWarn) oldWarn.remove();

        // Caminho da imagem do comprovante
        const src = '/imagens/comprovante.png';  // Caminho fixo para a imagem do comprovante

        await new Promise((resolve, reject) => {
            const probe = new Image();
            probe.decoding = 'async';
            probe.onload = resolve;
            probe.onerror = reject;
            probe.src = src;
        });

        img.src = src + (src.includes('?') ? '&' : '?') + 't=' + Date.now(); // Adicionando timestamp para evitar cache
        img.alt = 'Comprovante gerado';
        img.loading = 'eager';
        img.decoding = 'sync';

        img.classList.remove('hidden');
        skeleton.classList.add('hidden');
        console.log('[Comprovante] imagem exibida');
    } catch (e) {
        console.error('[Comprovante] falhou:', e);
        const step14 = document.getElementById('step14') || document.body;

        let warn = document.getElementById('comprovanteError');
        if (!warn) {
            warn = document.createElement('div');
            warn.id = 'comprovanteError';
            warn.className = 'mt-3 text-sm text-red-700 bg-red-50 border border-red-200 rounded-md p-3';
            step14.appendChild(warn);
        }
        warn.textContent = 'Não foi possível gerar o comprovante agora. Detalhe: ' + (e?.message || 'erro desconhecido');

        const skeleton = document.getElementById('comprovanteSkeleton');
        if (skeleton) skeleton.classList.add('hidden');

        const img = document.getElementById('comprovanteImg');
        if (img) {
            img.removeAttribute('src');
            img.classList.add('hidden');
        }
    }
}
