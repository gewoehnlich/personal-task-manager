#!/bin/sh

set -e

if [ "$APP_ENV" = "local" ]; then
  exec npm run dev
else
  tail -f /dev/null
fi
