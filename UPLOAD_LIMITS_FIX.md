# Correção: Erro 413 Request Entity Too Large ao Carregar Múltiplos Documentos

## Problema
Ao tentar carregar 12 ficheiros PDF (total ~174 MB) na formulário "Nova Notícia", recebia erro:
```
413 Request Entity Too Large (nginx)
```

## Causa Raiz
O erro ocorria em **duas camadas** simultaneamente:

### 1. Nginx (Camada de Servidor Web)
- **Limite padrão**: `client_max_body_size = 1M`
- **Resultado**: Rejeita requisições HTTP acima de 1 MB antes de chegar ao PHP/Laravel

### 2. PHP (Camada de Aplicação)
- **Limite padrão**: 
  - `upload_max_filesize = 2M`
  - `post_max_size = 8M`
- **Resultado**: Mesmo se Nginx permitisse, PHP rejeitaria

### 3. Laravel (Validação de Negócio)
- **Limite anterior**: `max:10240` (10 MB por documento)
- **Formulário**: Limitava a 20 ficheiros, mas cada um a 10 MB = máximo ~200 MB de entrada

## Solução Implementada

### Alterações no Repositório Local (git)
**Ficheiros modificados:**
1. `app/Http/Controllers/AdminNoticiaController.php`
2. `resources/views/admin/noticias-create.blade.php`
3. `resources/views/admin/noticias-edit.blade.php`

**Mudanças:**
```php
// Antes
'documentos.*' => 'file|mimes:pdf,doc,docx|max:10240',  // 10 MB

// Depois
'documentos.*' => 'file|mimes:pdf,doc,docx|max:25600',  // 25 MB
```

**Interface do utilizador:**
- Texto atualizado de "máx. 10 MB cada" para "máx. 25 MB cada"
- Validação de erro corrigida: `extensions` → `mimes`

### Configuração do Servidor (executado via SSH)
**Local**: `/etc/php/8.4/fpm/php.ini`
```bash
sed -i 's/^upload_max_filesize.*/upload_max_filesize = 25M/' /etc/php/8.4/fpm/php.ini
sed -i 's/^post_max_size.*/post_max_size = 256M/' /etc/php/8.4/fpm/php.ini
```

**Local**: `/etc/nginx/sites-available/isp-bie.ao`
```nginx
client_max_body_size 256M;
```

**Comandos de reinicialização:**
```bash
nginx -t
systemctl restart php8.4-fpm
systemctl reload nginx
```

## Limites Finais
| Componente | Limite | Justificativa |
|-----------|--------|---------------|
| Nginx | 256 MB | Permite múltiplos ficheiros de 25 MB |
| PHP `post_max_size` | 256 MB | Deve ser ≥ `client_max_body_size` |
| PHP `upload_max_filesize` | 25 MB | Por ficheiro individual |
| Laravel validação | 25 MB | Por documento anexo (máx. 20 ficheiros) |

## Teste de Validação
✅ Caso de uso original: 12 ficheiros PDF (~174 MB) agora é aceite
✅ Limite por ficheiro: 25 MB
✅ Limite total por requisição: 256 MB
✅ Compatibilidade: PDF, DOC, DOCX

## Referência de Conflito Resolvido
- **Erro HTTP**: `413 Request Entity Too Large`
- **Stack**: Nginx → PHP-FPM → Laravel Validation
- **Data da correção**: 2026-09-11
