FROM alpine:3.6

ENV PYTHONUNBUFFERED 1

RUN apk add --no-cache python3 py3-psycopg2
RUN pip3 install \
    tornado==4.5 \
    cerberus==1.0.1 \
    Momoko==2.2.4 \
    stripe \
    raven

CMD python3

RUN addgroup -S docker && adduser -S -G docker docker
USER docker