FROM debian:stretch-slim

ENV PYTHONUNBUFFERED 1

RUN apt-get update && apt-get install -y --no-install-recommends \
    python3 python3-dev bash
CMD python3

ARG USER_ID=1000
ARG GROUP_ID=500
RUN addgroup --quiet --gid=$GROUP_ID docker && \
    adduser --quiet --uid=$USER_ID --gid=$GROUP_ID docker && \
    umask 0027
