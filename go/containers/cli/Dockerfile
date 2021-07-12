FROM golang:1.16
ENV USER_ID=1000

WORKDIR /src
COPY src/ /src
RUN mkdir /results
RUN mkdir /.cache
RUN chown $USER_ID:$USER_ID /results
RUN chown $USER_ID:$USER_ID /.cache
RUN go build ./benchmarks.go
USER $USER_ID
