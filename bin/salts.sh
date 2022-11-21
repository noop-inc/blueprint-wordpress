#!/usr/bin/env sh
salt() {
  LC_ALL=C tr -dc 'A-Za-z0-9!#$%&'\''():"*+,-./;<=>?@[\]^_`{|}~' </dev/urandom | head -c 65 ; echo
}

jq -crnM \
  --arg AUTH_KEY "$(salt)" \
  --arg SECURE_AUTH_KEY "$(salt)" \
  --arg LOGGED_IN_KEY "$(salt)" \
  --arg NONCE_KEY "$(salt)" \
  --arg AUTH_SALT "$(salt)" \
  --arg SECURE_AUTH_SALT "$(salt)" \
  --arg LOGGED_IN_SALT "$(salt)" \
  --arg NONCE_SALT "$(salt)" \
  '{
         AUTH_KEY: $AUTH_KEY,
         SECURE_AUTH_KEY: $SECURE_AUTH_KEY,
         LOGGED_IN_KEY: $LOGGED_IN_KEY,
         NONCE_KEY: $NONCE_KEY,
         AUTH_SALT: $AUTH_SALT,
         SECURE_AUTH_SALT: $SECURE_AUTH_SALT,
         LOGGED_IN_SALT: $LOGGED_IN_SALT,
         NONCE_SALT: $NONCE_SALT
} | to_entries | { variables: . }'
