const yargs = require("yargs");
const fs = require("fs");
const Benchmark = require("./lib/benchmark");
// Functions
const concat = require("./functions/concat");
const counter = require("./functions/counter");
const arrayfill = require("./functions/arrayfill");
const mapfill = require("./functions/mapfill");
const fileread = require("./functions/fileread");

// Get iterations
const argv = yargs.option("iter", {
  alias: "i",
  description: "set number of iterations for the benchmark",
  type: Number,
}).argv;

let iterations = argv.iter;

if (iterations < 1) {
  iterations = 100;
}

let benchmark = new Benchmark();
benchmark
  .setIter(iterations)
  .add("Concatenate Strings", concat)
  .add("Counter", counter)
  .add("Array Fill", arrayfill)
  .add("Map Fill", mapfill)
  .add("File Read", fileread)
  .run();

let resultsJSON = benchmark.getJSON();
try {
  fs.writeFileSync(`/results/results-node-cli-${iterations}.json`, resultsJSON);
} catch (err) {
  console.error("Error while writing results:", err);
}
