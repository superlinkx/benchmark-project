const http = require("http");
const fs = require("fs");
const path = require("path");
const Router = require("./router");
const concat = require("../../functions/concat");
const counter = require("../../functions/counter");
const arrayfill = require("../../functions/arrayfill");
const mapfill = require("../../functions/mapfill");
const jsondecode = require("../../functions/jsondecode");
const fileread = require("../../functions/fileread");

// Setup
try {
  jsonData = fs.readFileSync(path.resolve(__dirname, "../../data/demo.json"));
} catch (err) {
  console.error("Error reading JSON file:", err);
}

// Router
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
  .addRoute("/jsondecode", () => {
    return { data: jsondecode(jsonData) };
  })
  .addRoute("/fileread", () => {
    return { data: fileread(path.resolve(__dirname, "../../data/demo.txt")) };
  });

// Server
http
  .createServer((req, res) => {
    router.handle(req, res);
  })
  .listen(5000);
