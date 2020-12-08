# discuzQ_seo_app

A laravel app to serve search engine friendly discuz! Q content. 

## Setup & Run
1. copy .env.example to .env and update config properly.
2. run "php artisan key:generate" to generate app key.
3. run "./dev_start.sh" to start local dev serving, the service will run on http://127.0.0.1:8000 by default, alternatively you can also serve this app by nginx with php-fpm.
4. config nginx to forward search engine traffic to this app according to user-agent.

Tested on ubuntu 16.04, centos 7.6 and MacOS 10.15.

## Dependency
Laravel requires PHP 7.3 or above to run.


## Alternatives
A Dockerfile is included in this repo. You can also use the "docker_build.sh" script to build a docker image and use the "docker_start.sh" script to run this app as a docker container.


## Author
* Jamesweng for https://mahjong.chat
* Contact: 6080901 (WeChat)

## License

[Apache License 2.0](LICENSE)
