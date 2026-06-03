#!/usr/bin/env bash
set -euo pipefail

HOSTNAME="${1:-mppl.test}"
HOSTS_FILE="/etc/hosts"
ENTRY="127.0.0.1 ${HOSTNAME}"

if awk -v host="${HOSTNAME}" '
    $1 == "127.0.0.1" {
        for (i = 2; i <= NF; i++) {
            if ($i == host) {
                found = 1
            }
        }
    }
    END {
        exit found ? 0 : 1
    }
' "${HOSTS_FILE}"; then
    echo "${HOSTNAME} already points to 127.0.0.1 in ${HOSTS_FILE}."
    exit 0
fi

echo "Adding ${ENTRY} to ${HOSTS_FILE}..."

if [ "${EUID}" -eq 0 ]; then
    printf '\n%s\n' "${ENTRY}" >> "${HOSTS_FILE}"
else
    printf '\n%s\n' "${ENTRY}" | sudo tee -a "${HOSTS_FILE}" > /dev/null
fi

echo "Done. You can open https://${HOSTNAME}"
