# Vercel Environment Variables

Ei file-e thaka man-gulo Vercel Dashboard → Settings → Environment Variables e add korun.

## Required Variables

| Variable | Value | Keno |
|----------|-------|------|
| `APP_KEY` | `base64:rFc23v3iJyU4S5uTkNgulwvNyPGjCfSonfNGJ7jfU5Y=` | App encryption key |
| `APP_URL` | `https://your-domain.vercel.app` | Apnar Vercel domain (deploy hoye por update korun) |
| `APP_ENV` | `production` | Production mode |
| `APP_DEBUG` | `false` | Error detail hide korar jonno |

## Database (Neon PostgreSQL)

| Variable | Value |
|----------|-------|
| `DB_CONNECTION` | `pgsql` |
| `DB_HOST` | `ep-wild-grass-azrw6c4e-pooler.c-3.ap-southeast-1.aws.neon.tech` |
| `DB_PORT` | `5432` |
| `DB_DATABASE` | `neondb` |
| `DB_USERNAME` | `neondb_owner` |
| `DB_PASSWORD` | `npg_R8ITBCd5KJHF` |

## Session, Cache, Queue

| Variable | Value |
|----------|-------|
| `SESSION_DRIVER` | `database` |
| `CACHE_STORE` | `array` |
| `QUEUE_CONNECTION` | `sync` |

## Optional

| Variable | Value |
|----------|-------|
| `LOG_CHANNEL` | `errorlog` |
| `LOG_LEVEL` | `error` |
| `MAIL_MAILER` | `log` |

---

## Kibhabe add korben

1. Vercel Dashboard → **Your Project** → **Settings** → **Environment Variables**
2. Ek ek kore upore thaka variable-gulo add korun
3. **Add** click korun
4. Project-e **Redeploy** korun

---

## ⚠️ Important

- `APP_URL` deploy hoye por actual Vercel domain-e change korun (https://xxxx.vercel.app)
- `.env` file git commit kora hoy na — environment variables shudhu Vercel Dashboard-e thakbe
- Neon PostgreSQL e SSL required — Laravel `pgsql` driver handle kore ta
