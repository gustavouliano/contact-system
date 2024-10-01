#!/bin/bash

# Aguardar até que o PostgreSQL esteja pronto
sleep 35

php bin/doctrine.php orm:schema-tool:create

php -S 0.0.0.0:8001 -t src