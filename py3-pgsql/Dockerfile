FROM python:3.6-alpine
ENV PYTHONUNBUFFERED 1

RUN apk --no-cache add \
    gcc linux-headers musl-dev ca-certificates libpq postgresql-dev

COPY requirements.txt /tmp/req.txt
RUN pip3 install --no-cache-dir -r /tmp/req.txt
