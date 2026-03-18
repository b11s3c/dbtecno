#!/usr/bin/env bash
set -euo pipefail

SOURCE_DIR="laravel-app"
TARGET_DIR="${1:-dbtecno-shop-laravel}"

if [ ! -d "$SOURCE_DIR" ]; then
  echo "[HATA] Kaynak Laravel uygulaması bulunamadı: $SOURCE_DIR" >&2
  exit 1
fi

if [ -e "$TARGET_DIR" ]; then
  echo "[HATA] Hedef klasör zaten mevcut: $TARGET_DIR" >&2
  exit 1
fi

echo "[1/5] Laravel uygulaması kopyalanıyor: $TARGET_DIR"
mkdir -p "$TARGET_DIR"
rsync -a "$SOURCE_DIR/" "$TARGET_DIR/"

if [ ! -f "$TARGET_DIR/.env" ] && [ -f "$TARGET_DIR/.env.example" ]; then
  echo "[2/5] .env dosyası hazırlanıyor"
  cp "$TARGET_DIR/.env.example" "$TARGET_DIR/.env"
else
  echo "[2/5] .env adımı atlandı"
fi

echo "[3/5] SQLite dosyası garanti ediliyor"
mkdir -p "$TARGET_DIR/database"
touch "$TARGET_DIR/database/database.sqlite"

echo "[4/5] Yeni git deposu başlatılıyor"
(
  cd "$TARGET_DIR"
  git init -q
  git add .
  git commit -m "Initial DBtecno Laravel rewrite" >/dev/null || true
)

echo "[5/5] Sonraki adımlar"
echo "    cd $TARGET_DIR"
echo "    composer install"
echo "    php artisan key:generate"
echo "    php artisan migrate --seed"
echo "    php artisan serve"
