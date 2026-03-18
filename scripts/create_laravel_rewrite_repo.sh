#!/usr/bin/env bash
set -euo pipefail

TARGET_DIR="${1:-dbtecno-ecommerce-laravel}"

if ! command -v composer >/dev/null 2>&1; then
  echo "[HATA] composer bulunamadı. Önce Composer kurun." >&2
  exit 1
fi

if [ -e "$TARGET_DIR" ]; then
  echo "[HATA] Hedef klasör zaten mevcut: $TARGET_DIR" >&2
  exit 1
fi

echo "[1/7] Yeni Laravel projesi oluşturuluyor: $TARGET_DIR"
composer create-project laravel/laravel "$TARGET_DIR"

echo "[2/7] DBtecno rewrite dosyaları aktarılıyor"
rsync -a dbtecno-laravel-rewrite/app/ "$TARGET_DIR/app/"
rsync -a dbtecno-laravel-rewrite/routes/ "$TARGET_DIR/routes/"
rsync -a dbtecno-laravel-rewrite/database/migrations/ "$TARGET_DIR/database/migrations/"
rsync -a dbtecno-laravel-rewrite/resources/views/ "$TARGET_DIR/resources/views/"

echo "[3/7] Uygulama anahtarı üretiliyor"
(
  cd "$TARGET_DIR"
  php artisan key:generate
)

echo "[4/7] Git deposu başlatılıyor"
(
  cd "$TARGET_DIR"
  git init -q
  git add .
  git commit -m "Initial DBtecno Laravel rewrite" >/dev/null
)

echo "[5/7] Veritabanı ayarları için .env dosyasını düzenleyin"
echo "[6/7] Migration çalıştırın: cd $TARGET_DIR && php artisan migrate"
echo "[7/7] Uygulamayı başlatın: cd $TARGET_DIR && php artisan serve"

echo "Tamamlandı. Yeni repo: $TARGET_DIR"
