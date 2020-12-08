#!/bin/bash
sudo docker rm --force discuzq_seo
sudo docker run -d --restart=always --name discuzq_seo \
    -p 8081:8080 -v "`pwd`/nginx.conf:/etc/nginx/nginx.conf" \
    discuzq_seo:1.0
