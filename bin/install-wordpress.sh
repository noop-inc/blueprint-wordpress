#!/usr/bin/env bash

set -eux

# INPUT_JSON=$(</dev/stdin)
# INPUT_VARS="$(echo "${INPUT_JSON}" | jq \
#             --compact-output \
#             --raw-output \
#             --monochrome-output \
#             'to_entries | map("\(.key)=\(.value)") | .[]')"

# echo "$INPUT_VARS"
# export $INPUT_VARS

wp core install \
  --allow-root \
  --no-color \
  --url="${WP_SITEURL}" \
  --title="${SITE_TITLE}" \
  --admin_user="${ADMIN_USER}" \
  --admin_email="${ADMIN_EMAIL}"
