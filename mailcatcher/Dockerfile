FROM ruby:2.2.3
RUN gem install mailcatcher
CMD mailcatcher --foreground --smtp-ip=0.0.0.0 --smtp-port=1025 --http-ip=0.0.0.0 --http-port=1080

