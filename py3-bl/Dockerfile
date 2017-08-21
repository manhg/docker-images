FROM alpine:3.6

ENV PYTHONUNBUFFERED 1

RUN apk add --no-cache python3 py3-psycopg2 bash
RUN pip3 install \
    tornado==4.5 \
    cerberus==1.0.1 \
    Momoko==2.2.4 \
    stripe \
    raven

CMD python3

ARG USER_ID=1000
ARG GROUP_ID=500
RUN addgroup -g $GROUP_ID docker && \
    adduser -D -u $USER_ID -G docker docker && \
    umask 0027
USER $USER_ID
