[![Build Status](https://cloud.drone.io/api/badges/ganboonhong/mask-map/status.svg)](https://cloud.drone.io/ganboonhong/mask-map)

![](https://github.com/ganboonhong/mask-map/workflows/Greet%20Everyone/badge.svg)


### A mask map implementation with Yii framework

### Nginx recommended Nginx Configuration for Yii application
https://github.com/yiisoft/yii2/blob/master/docs/guide/start-installation.md

### server configuration
```
server {
	#listen 443 ssl;

	root /var/www/html/my-lab/mask-map/web;

	# Add index.php to the list if you are using PHP
	index index.php index.html index.htm index.nginx-debian.html;

	server_name my-lab.ddns.net;

	location / {
        # Redirect everything that isn't a real file to index.php
		try_files $uri $uri/ /index.php$is_args$args;
	}

	location ~ \.php$ {
        	include snippets/fastcgi-php.conf;
        	fastcgi_pass unix:/run/php/php7.0-fpm.sock;
    	}

    	location ~ /\.ht {
        	deny all;
    	}

    listen [::]:443 ssl; # managed by Certbot
    listen 443 ssl; # managed by Certbot
    ssl_certificate /etc/letsencrypt/live/my-lab.ddns.net/fullchain.pem; # managed by Certbot
    ssl_certificate_key /etc/letsencrypt/live/my-lab.ddns.net/privkey.pem; # managed by Certbot
    include /etc/letsencrypt/options-ssl-nginx.conf; # managed by Certbot
    ssl_dhparam /etc/letsencrypt/ssl-dhparams.pem; # managed by Certbot

}


server {
    if ($host = my-lab.ddns.net) {
        return 301 https://$host$request_uri;
    } # managed by Certbot


	listen 80;
	listen [::]:80;

	server_name my-lab.ddns.net;
    return 404; # managed by Certbot
}

```
