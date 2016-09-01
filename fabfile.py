#!/usr/bin/env python
from __future__ import print_function

import os
import re
import random
import string

from fabric.operations import local, put
from fabric.context_managers import lcd, cd, hide
from fabric.contrib.project import rsync_project
from fabric.contrib.files import exists
from fabric.api import run, env, hosts
from fabric.api import settings
from fabric.colors import green, red, yellow

from fabric.decorators import runs_once


@hosts('giang@ss-docker.ml')
def set_nginx():
    put('nginx.conf', '/etc/nginx/conf.d/dyn_port.conf')

