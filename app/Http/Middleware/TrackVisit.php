<?php

namespace App\Http\Middleware;

use App\Models\SiteVisita;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class TrackVisit
{
    // Prefixos de rotas a ignorar (painel admin/portal/API)
    private const SKIP_PREFIXES = [
        'admin', 'tecnico', 'daac', 'portal',
        '_debugbar', 'telescope', 'horizon', 'up',
    ];

    // Palavras-chave de bots/crawlers no User-Agent
    private const BOT_AGENTS = [
        'bot', 'crawl', 'spider', 'slurp', 'fetch', 'archive',
        'mediapartners', 'facebookexternalhit', 'whatsapp', 'preview',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Só rastrear GET bem-sucedidos (200-299)
        if (! $request->isMethod('GET') || $response->getStatusCode() >= 300) {
            return $response;
        }

        // Ignorar AJAX e prefetch
        if ($request->ajax() || $request->headers->get('Purpose') === 'prefetch') {
            return $response;
        }

        // Ignorar rotas de gestão e sistema
        $path = ltrim($request->path(), '/');
        foreach (self::SKIP_PREFIXES as $prefix) {
            if ($path === $prefix || str_starts_with($path, $prefix . '/')) {
                return $response;
            }
        }

        // Ignorar bots
        $ua = strtolower($request->userAgent() ?? '');
        foreach (self::BOT_AGENTS as $bot) {
            if (str_contains($ua, $bot)) {
                return $response;
            }
        }

        // Determinar país (cache por IP hash para não sobrecarregar API)
        $ip      = $request->ip();
        $cacheKey = 'visit_geo_' . sha1($ip);

        [$pais, $paisCode] = Cache::remember($cacheKey, now()->addHours(6), function () use ($request, $ip) {
            return $this->resolveCountry($request, $ip);
        });

        // Registar visita de forma assíncrona via after-response
        SiteVisita::create([
            'pais'      => $pais,
            'pais_code' => $paisCode,
            'pagina'    => '/' . ltrim($request->path(), '/'),
        ]);

        return $response;
    }

    private function resolveCountry(Request $request, string $ip): array
    {
        // 1. Cloudflare injeta o país directamente (grátis, sem API call)
        $cf = $request->headers->get('CF-IPCountry');
        if ($cf && strlen($cf) === 2 && $cf !== 'XX' && $cf !== 'T1') {
            return [$this->codeToName($cf), strtoupper($cf)];
        }

        // 2. Outros reverse-proxies (X-Country, etc.)
        $xc = $request->headers->get('X-Country-Code') ?? $request->headers->get('X-GeoIP-Country');
        if ($xc && strlen($xc) === 2) {
            return [$this->codeToName($xc), strtoupper($xc)];
        }

        // 3. IP local/privado → Angola (servidor local)
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false) {
            return ['Angola', 'AO'];
        }

        // 4. ip-api.com (gratuito, 45 req/min — só chega aqui se sem Cloudflare)
        try {
            $ctx = stream_context_create(['http' => ['timeout' => 2]]);
            $raw = @file_get_contents("http://ip-api.com/json/{$ip}?fields=country,countryCode", false, $ctx);
            if ($raw) {
                $data = json_decode($raw, true);
                if (! empty($data['country'])) {
                    $code = strtoupper($data['countryCode'] ?? '??');
                    $name = $this->codeToName($code) ?: $data['country'];
                    return [$name, $code];
                }
            }
        } catch (\Throwable) {
        }

        return ['Desconhecido', '??'];
    }

    // Mapa de códigos ISO 3166-1 para nomes em português
    private function codeToName(string $code): string
    {
        $map = [
            'AO' => 'Angola',           'MZ' => 'Moçambique',       'CV' => 'Cabo Verde',
            'ST' => 'São Tomé e Príncipe','GW'=> 'Guiné-Bissau',   'GQ' => 'Guiné Equatorial',
            'TL' => 'Timor-Leste',      'ZA' => 'África do Sul',    'NG' => 'Nigéria',
            'KE' => 'Quénia',           'GH' => 'Gana',             'CM' => 'Camarões',
            'CD' => 'RD Congo',         'CG' => 'Congo',            'NA' => 'Namíbia',
            'ZM' => 'Zâmbia',           'ZW' => 'Zimbabué',         'BW' => 'Botswana',
            'TZ' => 'Tanzânia',         'SN' => 'Senegal',          'ET' => 'Etiópia',
            'UG' => 'Uganda',           'CI' => 'Costa do Marfim',  'TN' => 'Tunísia',
            'DZ' => 'Argélia',          'MA' => 'Marrocos',         'EG' => 'Egipto',
            'RW' => 'Ruanda',           'ML' => 'Mali',             'MG' => 'Madagáscar',
            'PT' => 'Portugal',         'BR' => 'Brasil',           'US' => 'Estados Unidos',
            'GB' => 'Reino Unido',      'FR' => 'França',           'DE' => 'Alemanha',
            'ES' => 'Espanha',          'IT' => 'Itália',           'NL' => 'Países Baixos',
            'BE' => 'Bélgica',          'CH' => 'Suíça',            'SE' => 'Suécia',
            'NO' => 'Noruega',          'DK' => 'Dinamarca',        'FI' => 'Finlândia',
            'PL' => 'Polónia',          'RO' => 'Roménia',          'AT' => 'Áustria',
            'UA' => 'Ucrânia',          'CZ' => 'Rep. Checa',       'HU' => 'Hungria',
            'GR' => 'Grécia',           'HR' => 'Croácia',          'SK' => 'Eslováquia',
            'BG' => 'Bulgária',         'RS' => 'Sérvia',           'IE' => 'Irlanda',
            'RU' => 'Rússia',           'CA' => 'Canadá',           'MX' => 'México',
            'AR' => 'Argentina',        'CO' => 'Colômbia',         'CL' => 'Chile',
            'PE' => 'Peru',             'VE' => 'Venezuela',        'EC' => 'Equador',
            'BO' => 'Bolívia',          'UY' => 'Uruguai',          'PY' => 'Paraguai',
            'CN' => 'China',            'JP' => 'Japão',            'IN' => 'Índia',
            'KR' => 'Coreia do Sul',    'ID' => 'Indonésia',        'MY' => 'Malásia',
            'SG' => 'Singapura',        'TH' => 'Tailândia',        'VN' => 'Vietname',
            'PH' => 'Filipinas',        'BD' => 'Bangladesh',       'PK' => 'Paquistão',
            'TW' => 'Taiwan',           'HK' => 'Hong Kong',        'MN' => 'Mongólia',
            'KZ' => 'Cazaquistão',      'TR' => 'Turquia',          'SA' => 'Arábia Saudita',
            'AE' => 'Emirados Árabes',  'IL' => 'Israel',           'IR' => 'Irão',
            'IQ' => 'Iraque',           'JO' => 'Jordânia',         'LB' => 'Líbano',
            'QA' => 'Qatar',            'KW' => 'Kuwait',           'OM' => 'Omã',
            'AU' => 'Austrália',        'NZ' => 'Nova Zelândia',
        ];

        return $map[strtoupper($code)] ?? strtoupper($code);
    }
}
