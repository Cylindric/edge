#!/bin/sh

# https://stedolan.github.io

cd `dirname $0`
rm *.json

jq -s '' core/*.json > combined000-core.json
jq -s '' edge_of_the_empire/*.json > combined100-edge_of_the_empire.json

jq -s '' suns_of_fortune/*.json > combined101-suns_of_fortune.json
jq -s '' dangerous_covenants/*.json > combined102-dangerous_covenants.json
jq -s '' desperate_allies/*.json > combined103-desperate_allies.json
jq -s '' enter_the_unknown/*.json > combined104-enter_the_unknown.json
jq -s '' far_horizons/*.json > combined105-far_horizons.json

jq -s '' age_of_rebellion/*.json > combined200-age_of_rebellion.json

jq -s '' force_and_destiny/*.json > combined300-force_and_destiny.json

jq -s '' combined???-*.json > /tmp/combined.json

jq -s 'flatten' /tmp/combined.json > combined.json


rm /tmp/combined.json