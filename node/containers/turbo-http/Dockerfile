FROM node:16
ENV USER_ID=1000

WORKDIR /src
RUN npm install --save turbo-http

COPY src/ /src

CMD ["node", "/src/api/turbo/server.js"]