#!/bin/bash

SCRIPT="$(readlink --canonicalize-existing "$0")"
SCRIPTPATH="$(dirname "$SCRIPT")"

echo

echo "1. Populating DB by running fixtures"
echo "===================================="

php "${SCRIPTPATH}"/bin/console doctrine:fixtures:load -n