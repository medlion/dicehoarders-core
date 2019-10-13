#!/bin/bash

SCRIPT="$(readlink --canonicalize-existing "$0")"
SCRIPTPATH="$(dirname "$SCRIPT")"

echo

echo "1. Running Composer Install"
echo "==========================="

cd "${SCRIPTPATH}" && composer install

echo "2. Cleaing Symfony Cache"
echo "========================"

php "${SCRIPTPATH}"/bin/console cache:clear