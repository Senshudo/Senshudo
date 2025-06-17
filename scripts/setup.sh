#!/bin/bash

set -euo pipefail
trap 'echo "Script interrupted. Exiting."; exit 1' INT TERM

# Variables
HOSTS_FILE="/etc/hosts"
CERT_PATH="$(pwd)/data/caddy/pki/authorities/local/root.crt"
DOMAINS=("api.senshudo.local" "ws.senshudo.local" "senshudo.local")

# Add domains to /etc/hosts if not present
for DOMAIN in "${DOMAINS[@]}"; do
    if ! grep -q "$DOMAIN" "$HOSTS_FILE"; then
        echo "Adding $DOMAIN to $HOSTS_FILE..."
        if [[ "$(uname)" == "Linux" ]] && grep -qi microsoft /proc/version; then
            echo "127.0.0.1  $DOMAIN" | sudo tee -a "$HOSTS_FILE" > /dev/null
            sudo sed -i "/::1[[:space:]]\+ip6-localhost[[:space:]]\+ip6-loopback/ { /$DOMAIN/! s/\$/ $DOMAIN/ }" "$HOSTS_FILE"
        else
            echo "127.0.0.1  $DOMAIN" | sudo tee -a "$HOSTS_FILE" > /dev/null
            echo "::1  $DOMAIN" | sudo tee -a "$HOSTS_FILE" > /dev/null
        fi
    else
        echo "$DOMAIN already present in $HOSTS_FILE."
    fi
done

# Check if the certificate file exists
if [ ! -f "$CERT_PATH" ]; then
  echo "Error: Certificate file not found at $CERT_PATH"
  exit 1
fi

# Add the certificate to the System keychain
echo "Adding certificate to System keychain..."

if [[ "$(uname)" == "Darwin" ]]; then
    sudo security add-trusted-cert -d -r trustRoot -k /Library/Keychains/System.keychain "$CERT_PATH"
else
    sudo cp "$CERT_PATH" /usr/local/share/ca-certificates/ || { echo "Failed to copy certificate."; exit 1; }
    sudo update-ca-certificates || { echo "Failed to update CA certificates."; exit 1; }
fi

echo "Certificate added successfully and marked as trusted."
