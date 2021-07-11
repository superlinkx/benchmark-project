const yargs = require("yargs");
const fs = require("fs");
const Benchmark = require("./helpers/benchmark");
const concat = require("./concat");

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
benchmark.setIter(iterations).add("Concatenate Strings", concat).run();

let resultsJSON = benchmark.getJSON();
try {
  fs.writeFileSync(`/results/results-node-${iterations}.json`, resultsJSON);
} catch (err) {
  console.error("Error while writing results:", err);
}
