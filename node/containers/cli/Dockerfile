FROM node:16
ENV USER_ID=1000

WORKDIR /src
RUN npm install --save yargs

COPY functions/ /src

RUN mkdir /results
RUN chown $USER_ID:$USER_ID /results
USER $USER_ID