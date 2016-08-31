FROM alpine:3.4

COPY requirements.txt /tmp/req.txt

RUN apk --no-cache add \
    gcc git linux-headers musl-dev ca-certificates \
    python3 python3-dev \
    freetds-dev freetds \
    && pip3 install --no-cache-dir \
        cython git+https://github.com/pymssql/pymssql.git@3bc299936fe2d35196dd4c9ebc8a22777f0c97e6 \
        gunicorn python-dotenv pymysql \
    && apk del gcc git linux-headers musl-dev python3-dev freetds-dev

RUN pip3 install --no-cache-dir -r /tmp/req.txt
