#!/bin/bash
echo "Deploying application"

cd /var/www/html/my-lab/mask-map && \
# cd ~/mask-map && \
git checkout master && \
git pull && \
echo "composer installing" && \
composer install --no-dev && \
echo "deployed successfully"