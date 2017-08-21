#!/bin/sh
psql -c 'SELECT pg_xlog_replay_pause();'
