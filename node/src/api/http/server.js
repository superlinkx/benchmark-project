const http = require("http");
const Router = require("./router");
const mapToObj = require("../../lib/map-to-obj");
const concat = require("../../functions/concat");
const counter = require("../../functions/counter");
const arrayfill = require("../../functions/arrayfill");
const mapfill = require("../../functions/mapfill");
const fileread = require("../../functions/fileread");

const router = new Router();
router
  .add404Handler(() => {
    return { error: "Route Not Found" };
  })
  .addRoute("/", () => {
    return { data: "Hello World" };
  })
  .addRoute("/concat", () => {
    return { data: concat() };
  })
  .addRoute("/counter", () => {
    return { data: counter() };
  })
  .addRoute("/arrayfill", () => {
    return { data: arrayfill() };
  })
  .addRoute("/mapfill", () => {
    return { data: [...mapfill()] }; // Maps can't be JSON encoded, so we have to expand to two dimensional array
  })
  .addRoute("/fileread", () => {
    return { data: fileread() };
  });

http
  .createServer((req, res) => {
    router.handle(req, res);
  })
  .listen(5000);
