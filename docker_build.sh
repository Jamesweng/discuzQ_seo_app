#!/bin/bash
mkdir -p release
sudo rm release/*
sudo docker build -t discuzq_seo:1.0 .
IMAGE_NAME=discuzq_seo-1.0
sudo docker save discuzq_seo:1.0 | gzip > release/$IMAGE_NAME.tgz
sudo chmod a+r release/$IMAGE_NAME.tgz
cp docker_start.sh release/
cp nginx.conf release/
