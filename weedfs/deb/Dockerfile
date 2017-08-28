FROM debian:9

RUN apt-get update && apt-get install -y --no-install-recommends \
    ca-certificates \
    wget
ENV DEBIAN_FRONTEND noninteractive
RUN wget --no-verbose -P /tmp https://github.com/chrislusf/seaweedfs/releases/download/0.76/linux_amd64.tar.gz && \
    tar -C /usr/bin/ -xzvf /tmp/linux_amd64.tar.gz

EXPOSE 8000
EXPOSE 8001
EXPOSE 9333

ARG USER_ID=1000
ARG GROUP_ID=500
RUN addgroup --quiet --gid=$GROUP_ID docker && \
    adduser --quiet --uid=$USER_ID --gid=$GROUP_ID docker && \
    umask 0027
RUN mkdir /data && chown docker:docker /data
VOLUME /data
WORKDIR /data
USER $USER_ID
CMD $USER_ID /usr/bin/weed server -dir=/data -filer -filer.port=8000 -master.port=9333 -volume.port=8001
