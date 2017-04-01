FROM alpine:3.4

RUN apk --update add curl

RUN curl -sL -o oauth2_proxy.tar.gz \
    "https://github.com/bitly/oauth2_proxy/releases/download/v2.1/oauth2_proxy-2.1.linux-amd64.go1.6.tar.gz" \
  && tar xzvf oauth2_proxy.tar.gz \
  && mv oauth2_proxy-2.1.linux-amd64.go1.6/oauth2_proxy /bin/ \
  && chmod +x /bin/oauth2_proxy \
  && rm -r oauth2_proxy*

ADD https://raw.githubusercontent.com/bitly/oauth2_proxy/v2.1/contrib/oauth2_proxy.cfg.example /etc/oauth2_proxy.cfg

ENTRYPOINT ["oauth2_proxy", "-config=/etc/oauth2_proxy.cfg"]