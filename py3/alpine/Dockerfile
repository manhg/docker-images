FROM alpine:3.6

ENV PYTHONUNBUFFERED 1

RUN apk add --no-cache python3 py3-psycopg2 bash

RUN apk add --no-cache --virtual .deps \
    python3-dev
ADD ./requirements.txt /tmp/requirements.txt
RUN pip3 install -r /tmp/requirements.txt
RUN apk del .deps

CMD python3

ARG USER_ID=1000
ARG GROUP_ID=500
RUN addgroup -g $GROUP_ID docker && \
    adduser -D -u $USER_ID -G docker docker && \
    umask 0027
USER $USER_ID
