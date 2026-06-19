# API mundo_app — Referência de Endpoints

Base URL: `https://seu-dominio.com/`

## Autenticação

A maioria das rotas exige dois headers:

| Header | Valor | Quando |
|---|---|---|
| `X-API-KEY` | chave fixa da aplicação | Em todas as rotas com filtro `secureApi` |
| `Authorization` | `Bearer <jwt_token>` | Em todas as rotas com filtro `jwtAuth` |

Fluxo:
1. `POST /api/auth/login` → recebe `token` (JWT) e `refresh_token`
2. Envia o `token` no header `Authorization: Bearer ...` nas chamadas seguintes
3. Quando expirar, chama `POST /api/auth/refresh` com o `refresh_token`

### Exemplo de login

```bash
curl -X POST https://seu-dominio.com/api/auth/login \
  -H "X-API-KEY: SUA_CHAVE" \
  -H "Content-Type: application/json" \
  -d '{"email":"a@b.com","password":"123"}'
```

Resposta:
```json
{
  "success": true,
  "data": {
    "token": "eyJ...",
    "refresh_token": "...",
    "expires_in": 3600,
    "user": { "id": 1, "nome": "...", "email": "..." }
  }
}
```

### Exemplo de chamada autenticada

```bash
curl https://seu-dominio.com/api/meets \
  -H "X-API-KEY: SUA_CHAVE" \
  -H "Authorization: Bearer eyJ..."
```

---

## Endpoints

### Autenticação (`api/auth`)

| Método | Rota | Descrição |
|---|---|---|
| POST | `api/auth/login` | Login → retorna `token` + `refresh_token` |
| POST | `api/auth/refresh` | Renova o `token` a partir do `refresh_token` |
| GET  | `api/auth/me` | Dados do usuário autenticado |

### Perfil (`api/perfil`)

| Método | Rota | Descrição |
|---|---|---|
| GET   | `api/perfil` | Dados do perfil do usuário logado |
| PUT/PATCH | `api/perfil` | Atualiza nome, email e dados do cliente |
| POST  | `api/perfil/senha` | Altera senha |
| POST  | `api/perfil/imagem` | Upload de foto de perfil |

### Ingressos (`api/ingressos`)

| Método | Rota | Descrição |
|---|---|---|
| GET | `api/ingressos` | Todos os ingressos do usuário |
| GET | `api/ingressos/atuais` | Apenas ingressos não expirados |
| GET | `api/ingressos/{id}` | Detalhes de um ingresso (com QR code) |

### Meet & Greet (`api/meets`)

| Método | Rota | Descrição |
|---|---|---|
| GET | `api/meets` | Reservas de M&G do usuário |
| GET | `api/meets?event_id={id}` | Filtra por evento |

Cada item retorna `id`, `meet_id`, `code`, `status` (PENDENTE/VALIDADO), `ordem`, `qr_code` (base64), dados do artista, dia/hora e do evento.

### Cronograma (`api/cronograma`)

| Método | Rota | Descrição |
|---|---|---|
| GET    | `api/cronograma` | Lista todos os cronogramas |
| GET    | `api/cronograma/{id}` | Detalhes de um cronograma |
| GET    | `api/cronograma/evento/{event_id}` | Cronogramas de um evento |
| GET    | `api/cronograma/evento/{event_id}/itens` | Cronogramas + itens do evento |
| POST   | `api/cronograma` | Cria cronograma |
| PUT/PATCH | `api/cronograma/{id}` | Atualiza |
| DELETE | `api/cronograma/{id}` | Exclui (soft delete) |
| POST   | `api/cronograma/{id}/restore` | Restaura cronograma excluído |

### Itens do Cronograma (`api/cronograma-item`)

| Método | Rota | Descrição |
|---|---|---|
| GET    | `api/cronograma-item` | Lista todos os itens |
| GET    | `api/cronograma-item/{id}` | Detalhes de um item |
| GET    | `api/cronograma-item/cronograma/{id}` | Itens de um cronograma |
| GET    | `api/cronograma-item/cronograma/{id}/proximos` | Próximos itens do cronograma |
| POST   | `api/cronograma-item` | Cria item |
| PUT/PATCH | `api/cronograma-item/{id}` | Atualiza item |
| PATCH  | `api/cronograma-item/{id}/status` | Atualiza apenas o status |
| DELETE | `api/cronograma-item/{id}` | Exclui item |

### Lineup (`api/lineup`)

| Método | Rota | Descrição |
|---|---|---|
| GET | `api/lineup/evento/{event_id}` | Lineup do evento |
| GET | `lineup/imagem/{arquivo}` | Serve imagem (pública, sem auth) |

### Banners (`api/banners`)

| Método | Rota | Descrição |
|---|---|---|
| GET | `api/banners?event_id={id}&ativo=1` | Lista banners (com filtros opcionais) |
| GET | `api/banners/evento/{id}` | Banners do evento |
| GET | `banners/imagem/{arquivo}` | Serve imagem (pública, sem auth) |

### Conquistas (`api/conquistas`)

| Método | Rota | Descrição |
|---|---|---|
| GET    | `api/conquistas` | Lista todas |
| GET    | `api/conquistas/{id}` | Detalhes |
| GET    | `api/conquistas/evento/{event_id}` | Conquistas de um evento |
| POST   | `api/conquistas` | Cria |
| PUT/PATCH | `api/conquistas/{id}` | Atualiza |
| DELETE | `api/conquistas/{id}` | Exclui |

### Atribuição de Conquistas (`api/usuario-conquistas`)

| Método | Rota | Descrição |
|---|---|---|
| GET  | `api/usuario-conquistas/usuario/{user_id}` | Conquistas do usuário |
| GET  | `api/usuario-conquistas/extrato/{user_id}` | Extrato de pontos |
| GET  | `api/usuario-conquistas/ranking/{event_id}` | Ranking por evento |
| POST | `api/usuario-conquistas/atribuir` | Atribui conquista por ID |
| POST | `api/usuario-conquistas/atribuir-por-codigo` | Atribui por código |
| POST | `api/usuario-conquistas/{id}/revogar` | Revoga conquista |

### Pontos (`api/usuarios`)

| Método | Rota | Descrição |
|---|---|---|
| POST | `api/usuarios/retirar-pontos` | Retira pontos (admin) |
| GET  | `api/usuarios/saldo/{user_id}` | Saldo de pontos do usuário |

### Produtos (`api/produtos`)

| Método | Rota | Descrição |
|---|---|---|
| GET    | `api/produtos` | Lista todos |
| GET    | `api/produtos/{id}` | Detalhes |
| GET    | `api/produtos/evento/{event_id}` | Produtos do evento |
| GET    | `api/produtos/categorias/{event_id}` | Categorias do evento |
| POST   | `api/produtos` | Cria |
| PUT/PATCH | `api/produtos/{id}` | Atualiza |
| DELETE | `api/produtos/{id}` | Exclui |

---

## Carrinho e Checkout (filtro `apiKey`, sem JWT)

Estas rotas usam apenas `X-API-KEY`, não exigem JWT — são usadas no fluxo público de compra.

### Carrinho (`api/carrinho`)

| Método | Rota | Descrição |
|---|---|---|
| GET  | `api/carrinho/evento/{id}` | Carrinho do evento |
| GET  | `api/carrinho/adicional/{id}` | Adicionais do evento |
| GET  | `api/carrinho/girafinhas/{id}` | Itens "girafinhas" |
| GET  | `api/carrinho/otakada/{id}` | Itens "otakada" |
| GET  | `api/carrinho/loja` | Itens da loja |
| GET  | `api/carrinho/clube` | Itens do clube |
| GET  | `api/carrinho/pucrs/{id}` | Itens PUCRS |
| GET  | `api/carrinho/marista/{id}` | Itens Marista |
| POST | `api/carrinho/adicionar` | Adiciona item ao carrinho |

### Checkout (`api/checkout`)

| Método | Rota | Descrição |
|---|---|---|
| GET  | `api/checkout/pix/{id}` | Tela de PIX |
| GET  | `api/checkout/cartao/{id}` | Tela de cartão |
| GET  | `api/checkout/loja` | Checkout da loja |
| GET  | `api/checkout/obrigado` | Tela de confirmação |
| GET  | `api/checkout/qrcode/{id}/{hash}` | QR code do pagamento |
| POST | `api/checkout/finalizarpix/{id}` | Finaliza compra PIX |
| POST | `api/checkout/finalizarcartao/{id}` | Finaliza compra com cartão |

---

## Webhooks e utilitários

| Método | Rota | Descrição |
|---|---|---|
| POST | `webhook/asaas` | Webhook do Asaas (PIX/assinaturas) |
| POST | `api/checkout/notify` | Notificação do Asaas (alternativa) |
| POST | `notify` | Alias do notify |
| POST | `api/acessos/check` | Validação de acesso |

---

## Como descobrir o payload de cada endpoint

Toda rota acima aponta para `App\Controllers\Api\<Controller>::<metodo>`. Abrindo o arquivo em [app/Controllers/Api/](app/Controllers/Api/) você vê:

- Parâmetros aceitos (`$this->request->getJSON()` / `getPost()` / `getGet()`)
- Validações
- Estrutura exata do JSON retornado

Esse é o "manual" sem Swagger — o controller é a fonte da verdade.

## Listar rotas pelo terminal

```bash
php spark routes
```

Mostra todos os métodos HTTP, rotas e controllers ativos no momento.

## Filtros aplicados

| Filtro | Função | Onde está |
|---|---|---|
| `secureApi` | Verifica `X-API-KEY`, HTTPS, rate limiting | [app/Filters/SecureApiFilter.php](app/Filters/) |
| `jwtAuth` | Valida JWT no header `Authorization` | [app/Filters/JwtAuthFilter.php](app/Filters/) |
| `apiKey` | Apenas valida `X-API-KEY` (rotas públicas de checkout) | [app/Filters/](app/Filters/) |
