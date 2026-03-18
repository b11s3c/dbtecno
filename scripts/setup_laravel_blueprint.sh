#!/usr/bin/env bash
set -euo pipefail

TARGET_DIR="${1:-dbtecno-laravel-local}"

bash "$(dirname "$0")/create_laravel_rewrite_repo.sh" "$TARGET_DIR"
