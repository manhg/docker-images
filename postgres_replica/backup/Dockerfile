FROM alpine:3.6
RUN apk add --no-cache postgresql-client
ADD backup.sh /usr/bin/backup.sh
CMD sh /usr/bin/backup.sh
