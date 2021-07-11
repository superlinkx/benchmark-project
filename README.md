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

## Env

There is a `.env.template` file tracked in the project root. If your uid is 1000, you don't need to worry about it. But if it isn't, you can change the `USER_ID` var to match your uid. Use `id -u` to check your uid. This ensures that files written to the `results` directory are owned by your user.
