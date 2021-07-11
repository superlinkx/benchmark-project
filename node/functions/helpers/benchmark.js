class Benchmark {
  #iterations = 1;
  #benchmarks = new Map();
  #results = {};

  #runBenchmark(benchmark) {
    let rawTimings = [];
    for (let i = 0; i < this.#iterations; i++) {
      let start, end, cpuTime;
      start = process.hrtime.bigint();
      benchmark();
      end = process.hrtime.bigint();
      cpuTime = Number(end - start);
      rawTimings.push(cpuTime);
    }
    let memUsed = process.memoryUsage();
    let average = this.#calculateAverage(rawTimings);
    return { memUsed, rawTimings, average };
  }
  #calculateAverage(timings) {
    let total = timings.reduce((accumulator, value) => accumulator + value);
    // Timings are counted in nanoseconds, converting average to microseconds and keeping sig digs
    return (total / this.#iterations / 1000).toFixed(3);
  }

  setIter(iterations) {
    this.#iterations = iterations;
    return this;
  }
  add(name, benchmark) {
    this.#benchmarks.set(name, benchmark);
    return this;
  }
  run() {
    this.#benchmarks.forEach((benchmark, name) => {
      console.info(`Running benchmark ${name}...`);
      this.#results[name] = this.#runBenchmark(benchmark);
      console.info(`Direct Time Average: ${this.#results[name].average}µs`);
      console.info(
        `Memory Usage: (rss: ${(
          this.#results[name].memUsed.rss /
          (1024 * 1024)
        ).toFixed(6)}MB, heapTotal: ${(
          this.#results[name].memUsed.heapTotal /
          (1024 * 1024)
        ).toFixed(6)}MB, heapUsed: ${(
          this.#results[name].memUsed.heapUsed /
          (1024 * 1024)
        ).toFixed(6)}MB)`
      );
    });
  }
  getJSON() {
    return JSON.stringify(this.#results);
  }
}

module.exports = Benchmark;
