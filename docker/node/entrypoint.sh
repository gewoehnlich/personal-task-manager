#!/bin/sh

set -e

if [ "$APP_ENV" = "local" ]; then
  exec npm run dev
fi

if [ "$APP_ENV" = "production" ]; then
  exec npm run build
fi
