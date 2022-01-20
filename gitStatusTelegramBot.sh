#!/bin/bash

TOKEN="843023517:AAHFzKKQSJVShzXPyvFvXawAGmyeSHSwRH8"
ID="372132470"
URL="https://api.telegram.org/bot$TOKEN/sendMessage"
DOMAIN="laruralservicios.com.ar"

[ -z $ID ] && { echo "ID User Telegram no está configurado!"; exit 1; }

# informacion del servidor

GITSHOW=`git log --stat -1 -q`

statusMessage() {
        echo -e "${DOMAIN} ha sido actualizado\n"
        echo -e "_Git Log:_\n\`\`\`${GITSHOW}\`\`\`\n\n"
        echo -e "by Plen.co\n"
    }

curl -s -X POST $URL -d chat_id=$ID -d parse_mode="Markdown" -d text="`statusMessage`"
exit 0
