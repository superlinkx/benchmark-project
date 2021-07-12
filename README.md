# Backend Language Benchmarks

## Requirements (for easy script running)

- Bash
- Docker
- Docker Compose

## Getting started

NOTE: Make sure you meet the prerequisites. This project has only been testing on Ubuntu 20.04 using WSL2 on Windows 11. In theory it might work on Mac OS, but should always work on Linux if the prereqs are met.

Run `bash run-benchmarks.sh` in the project root to startup a full benchmark run.  
Results will populate as files in the `results` folder. CLI results are in JSON format. API results are just the text output from `wrk` for now. Eventually I want to have them output as either CSV or JSON.

If Docker isn't your thing, you could potentially setup all the environments locally and run the scripts by hand. The following is a brief map of the project:

-|_ \<language\>/ - All files needed for benchmarking \<language\>  
--|_ config/ - All files needed to configure various services (like Nginx)  
--|_ containers/ - All files needed to configure Docker containers. Organized by platform type (cli, http, nginx, swoole, turbo-http, etc). This is where the `cli` benchmark commands can be found  
--|_ src/ - All source files for benchmarking  
----|_ benchmarks.\<lang\> - CLI benchmarking file  
----|_ api/ - API server definitions for benchmarking API platforms  
----|_ data/ - Data needed during benchmarking (like for file reading)  
----|_ functions/ - Individual functions to benchmark  
----|\_ lib/ - Utilities needed for writing benchmarks

## Benchmark Time

CLI benchmarks use wall clock timers. This gives the real-time it took each iteration, but doesn't distinguish how much actual processor time was used. A future improvement would be to also check the processor time for each benchmark.

## Memory Stat

The current memory stats in the CLI benchmarks is just a memory snapshot at the end of each function benchmark run. It's not particularly indicative of much since a large portion of the changes in memory usage can likely be contributed to my benchmarking code. A more meaningful memory stat should be found and implemented before doing memory usage comparisons.

## Env

There is a `.env.template` file tracked in the project root. If your uid is 1000, you don't need to worry about it. But if it isn't, you can change the `USER_ID` var to match your uid. Use `id -u` to check your uid. This ensures that files written to the `results` directory are owned by your user.

## Contribute

Feel free to file an issue with any features you'd like to see. If you find a bug, please create a new issue with as much detail as possible. Pull requests are welcome, just file an issue to track it.

## Credits

This project was inspired by [http://grigorov.website/blog/performance-comparison-php-vs-node-js](http://grigorov.website/blog/performance-comparison-php-vs-node-js). I wanted to take the testing further and look closer at language characteristics as well as server application performance metrics. Many of my basic tests are derivative of his tests.
