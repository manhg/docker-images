FROM python:3.6-alpine
ENV PYTHONUNBUFFERED 1

COPY requirements.txt /tmp/req.txt
RUN apk --no-cache add \
    gcc linux-headers musl-dev ca-certificates libpq postgresql-dev \
    && pip3 install --no-cache-dir -r /tmp/req.txt \
    && apk del gcc linux-headers musl-dev postgresql-dev
