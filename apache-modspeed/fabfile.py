#!/usr/bin/env python
from __future__ import print_function
import os

from fabric.operations import local
from fabric.context_managers import lcd, settings
from fabric.contrib.project import rsync_project
from fabric.api import run, env, hosts

@hosts(['ubuntu@mashi.ssc-aws.com'])
def deploy():
    src = os.path.join(os.path.dirname(__file__))
    dest = '/home/ubuntu/'
    rsync_project(
        dest, src,
        exclude=['.*']
    )