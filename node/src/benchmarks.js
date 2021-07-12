const yargs = require("yargs");
const fs = require("fs");
const path = require("path");
const Benchmark = require("./lib/benchmark");
// Functions
const concat = require("./functions/concat");
const counter = require("./functions/counter");
const arrayfill = require("./functions/arrayfill");
const mapfill = require("./functions/mapfill");
const jsondecode = require("./functions/jsondecode");
const fileread = require("./functions/fileread");

let jsonData = {};

// Get iterations
const argv = yargs.option("iter", {
  alias: "i",
  description: "set number of iterations for the benchmark",
  type: Number,
}).argv;

let iterations = argv.iter;

// Guard against zero/negative iterations
if (iterations < 1) {
  iterations = 100;
}

// Setup
try {
  jsonData = fs.readFileSync(path.resolve(__dirname, "./data/demo.json"));
} catch (err) {
  console.error("Error reading JSON file:", err);
}

// Benchmark
let benchmark = new Benchmark();
benchmark
  .setIter(iterations)
  .add("Concatenate Strings", concat)
  .add("Counter", counter)
  .add("Array Fill", arrayfill)
  .add("Map Fill", mapfill)
  .add("JSON Parse", jsondecode, jsonData)
  .add("File Read", fileread, path.resolve(__dirname, "./data/demo.txt"))
  .run();

// Write results to file
let resultsJSON = benchmark.getJSON();
try {
  fs.writeFileSync(`/results/results-node-cli-${iterations}.json`, resultsJSON);
} catch (err) {
  console.error("Error while writing results:", err);
}
