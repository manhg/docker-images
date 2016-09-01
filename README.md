# Docker

## 概要

* Dockerfile - イメージ作るのガイド。一つのイメージは一つのプロセスを実行の想定です。
* １案件は各部分から別イメージからdocker-composeで使うと完全環境を立てる。
* http://docs.docker.jp/engine/reference/glossary.html

# Dockerfile

* イメージは変更したいときに別 Dockerfileを書けます。
* イメージはLayersで保存するので、ご注文ください。
* すぐ使えるイメージ　は hub.docker.com で探せます。たとえば apache, php, mysql, python ...
* 実行プロセスは外からポートをアクセスできます
* https://hub.docker.com/u/sanwas で保存するイメージが出来ます、次回は早いになります。

## docker-compose.yml

* http://docs.docker.jp/compose/toc.html
*　イメージから実行だとcontainerという呼びます
* ContainerはVM見たいですが、VM じゃない

## Tips
* システムサービスをで実行のとき（たとえば、Gogs):
`$ docker run --restart=always -d image-name`

これは再起動と自動再実行

* 参照：https://docs.docker.com/engine/userguide/eng-image/dockerfile_best-practices/
* https://blog.replicated.com/2016/02/05/refactoring-a-dockerfile-for-image-size/

* `http://8xxx.ss-docker.ml` will proxy to `http://localhost:8xxx`
* ss-dockerはNginxで設定、ポートはsubdomainでアクセス出来ます。このrepoを`nginx.conf`をご覧ださい。
ユーザーは好きなポートでアプリを動く、subdomainをアクセスしてください。
