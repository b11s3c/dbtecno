#!/usr/bin/env bash
set -euo pipefail

if ! command -v composer >/dev/null 2>&1; then
  echo "[HATA] composer bulunamadı. Önce Composer kurun: https://getcomposer.org" >&2
  exit 1
fi

TARGET_DIR="${1:-dbtecno-laravel}"

if [ -e "$TARGET_DIR" ]; then
  echo "[HATA] Hedef klasör zaten var: $TARGET_DIR" >&2
  exit 1
fi

echo "[1/6] Laravel projesi oluşturuluyor: $TARGET_DIR"
composer create-project laravel/laravel "$TARGET_DIR"

echo "[2/6] Blueprint dosyaları kopyalanıyor"
rsync -a laravel-app/app/ "$TARGET_DIR/app/"
rsync -a laravel-app/routes/ "$TARGET_DIR/routes/"
rsync -a laravel-app/database/migrations/ "$TARGET_DIR/database/migrations/"
rsync -a laravel-app/resources/views/ "$TARGET_DIR/resources/views/"

echo "[3/6] Uygulama anahtarı üretiliyor"
(cd "$TARGET_DIR" && php artisan key:generate)

echo "[4/6] .env dosyanızı düzenleyin (DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD)"
echo "[5/6] Migration çalıştırın"
echo "    cd $TARGET_DIR && php artisan migrate"
echo "[6/6] Uygulamayı başlatın"
echo "    cd $TARGET_DIR && php artisan serve"

echo "Kurulum tamamlandı."
