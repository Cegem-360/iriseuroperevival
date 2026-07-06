#!/bin/bash
#
# Server-side auto-deploy script for iriseuroperevival.
#
# Pulls the latest commit from origin/main and, only when there is something
# new, runs the production deploy steps. Front-end assets are built locally
# and committed to git (the server has no Node), so no build step runs here.
#
# Invoked periodically by cron, e.g.:
#   */5 * * * * /usr/bin/flock -n /home/iriseuro/deploy.lock \
#     /home/iriseuro/repositories/iriseuroperevival/deploy.sh \
#     >> /home/iriseuro/repositories/iriseuroperevival/storage/logs/deploy.log 2>&1

set -euo pipefail

cd "$(dirname "$(readlink -f "$0")")"

PHP=/opt/cpanel/ea-php84/root/usr/bin/php
COMPOSER=/usr/local/bin/composer
BRANCH=main

git fetch --quiet origin "$BRANCH"

LOCAL="$(git rev-parse HEAD)"
REMOTE="$(git rev-parse "origin/$BRANCH")"

if [ "$LOCAL" = "$REMOTE" ]; then
    exit 0
fi

echo "==== Deploy $(date '+%Y-%m-%d %H:%M:%S') : $LOCAL -> $REMOTE ===="

git pull --ff-only origin "$BRANCH"

"$PHP" "$COMPOSER" install --no-dev --optimize-autoloader --no-interaction --prefer-dist
"$PHP" artisan migrate --force
"$PHP" artisan storage:link || true
"$PHP" artisan config:cache
"$PHP" artisan route:cache
"$PHP" artisan view:cache
"$PHP" artisan filament:optimize
"$PHP" artisan queue:restart

echo "==== Deploy complete $(date '+%Y-%m-%d %H:%M:%S') ===="
