#!/usr/bin/env bash
../manage.py collectstatic
uwsgi --reload /tmp/gfanniversary.pid
