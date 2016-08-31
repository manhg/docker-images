FROM alpine:3.4

RUN apk --no-cache add \
    gcc git linux-headers musl-dev ca-certificates \
    python3 python3-dev \
    freetds-dev freetds
RUN pip3 install --no-cache-dir cython
RUN pip3 install --no-cache-dir git+https://github.com/pymssql/pymssql.git@3bc299936fe2d35196dd4c9ebc8a22777f0c97e6
RUN pip3 install --no-cache-dir gunicorn python-dotenv pymysql
COPY requirements.txt /tmp/req.txt
RUN pip3 install -r /tmp/req.txt
