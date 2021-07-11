FROM php:8-cli

ENV USER_ID=1000
WORKDIR /src

COPY src/ /src

RUN mkdir /results
RUN chown $USER_ID:$USER_ID /results
USER $USER_ID