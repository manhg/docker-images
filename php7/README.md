Xdebug inside Docker
====================

* Copy `sample_launch.json` into `.vscode/launch.json`
* Change `localSourceRoot` to match your path
* Run:
    - (Mac) sudo ifconfig lo0 alias 10.254.254.254
    - (Linux) sudo ifconfig lo add 10.254.254.254
* Run `docker-compose up`
* Add a breakpoint inside `app/public/test.php`
* Open http://localhost:8700/test.php 