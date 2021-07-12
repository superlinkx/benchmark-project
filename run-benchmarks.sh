#!/bin/bash
THISDIR=`dirname "$0"`
RESULTSDIR="$THISDIR/results"
WRKTIME="-d1m"
WRKTHREAD="-t1"
WRKCONN="-c25"

### CLI
## Node
# Benchmarks
echo "Building Node CLI Benchmarks"
docker-compose -f node/containers/cli/docker-compose.yml build > /dev/null
echo "Running Node CLI Benchmarks"
docker-compose -f node/containers/cli/docker-compose.yml up
## PHP
# Benchmarks
echo "Building PHP CLI Benchmarks"
docker-compose -f php/containers/cli/docker-compose.yml build > /dev/null
echo "Running PHP CLI Benchmarks"
docker-compose -f php/containers/cli/docker-compose.yml up
## Go
# Benchmarks
echo "Building Go CLI Benchmarks"
docker-compose -f go/containers/cli/docker-compose.yml build > /dev/null
echo "Running Go CLI Benchmarks"
docker-compose -f go/containers/cli/docker-compose.yml up

exit
### API
## Node
# HTTP
echo "Setting Up Node HTTP Benchmarks"
docker-compose -f node/containers/http/docker-compose.yml build > /dev/null
docker-compose -f node/containers/http/docker-compose.yml up -d > /dev/null
echo "Running Node HTTP wrk Benchmarks"
docker run --rm --network=host williamyeh/wrk $WRKTHREAD $WRKTIME $WRKCONN http://localhost:5000/ > $RESULTSDIR/results-node-http-root.txt
docker run --rm --network=host williamyeh/wrk $WRKTHREAD $WRKTIME $WRKCONN http://localhost:5000/concat > $RESULTSDIR/results-node-http-concat.txt
docker run --rm --network=host williamyeh/wrk $WRKTHREAD $WRKTIME $WRKCONN http://localhost:5000/counter > $RESULTSDIR/results-node-http-counter.txt
docker run --rm --network=host williamyeh/wrk $WRKTHREAD $WRKTIME $WRKCONN http://localhost:5000/arrayfill > $RESULTSDIR/results-node-http-arrayfill.txt
docker run --rm --network=host williamyeh/wrk $WRKTHREAD $WRKTIME $WRKCONN http://localhost:5000/mapfill > $RESULTSDIR/results-node-http-mapfill.txt
docker run --rm --network=host williamyeh/wrk $WRKTHREAD $WRKTIME $WRKCONN http://localhost:5000/jsondecode > $RESULTSDIR/results-node-http-jsondecode.txt
docker run --rm --network=host williamyeh/wrk $WRKTHREAD $WRKTIME $WRKCONN http://localhost:5000/fileread > $RESULTSDIR/results-node-http-fileread.txt
echo "Tearing Down Node HTTP Benchmarks"
docker-compose -f node/containers/http/docker-compose.yml down > /dev/null
# Nginx
echo "Setting Up Node Nginx Benchmarks"
docker-compose -f node/containers/nginx/docker-compose.yml build > /dev/null
docker-compose -f node/containers/nginx/docker-compose.yml up -d > /dev/null
echo "Running Node Nginx wrk Benchmarks"
docker run --rm --network=host williamyeh/wrk $WRKTHREAD $WRKTIME $WRKCONN http://localhost:2929/ > $RESULTSDIR/results-node-nginx-root.txt
docker run --rm --network=host williamyeh/wrk $WRKTHREAD $WRKTIME $WRKCONN http://localhost:2929/concat > $RESULTSDIR/results-node-nginx-concat.txt
docker run --rm --network=host williamyeh/wrk $WRKTHREAD $WRKTIME $WRKCONN http://localhost:2929/counter > $RESULTSDIR/results-node-nginx-counter.txt
docker run --rm --network=host williamyeh/wrk $WRKTHREAD $WRKTIME $WRKCONN http://localhost:2929/arrayfill > $RESULTSDIR/results-node-nginx-arrayfill.txt
docker run --rm --network=host williamyeh/wrk $WRKTHREAD $WRKTIME $WRKCONN http://localhost:2929/mapfill > $RESULTSDIR/results-node-nginx-mapfill.txt
docker run --rm --network=host williamyeh/wrk $WRKTHREAD $WRKTIME $WRKCONN http://localhost:2929/jsondecode > $RESULTSDIR/results-node-nginx-jsondecode.txt
docker run --rm --network=host williamyeh/wrk $WRKTHREAD $WRKTIME $WRKCONN http://localhost:2929/fileread > $RESULTSDIR/results-node-nginx-fileread.txt
echo "Tearing Down Node Nginx Benchmarks"
docker-compose -f node/containers/nginx/docker-compose.yml down > /dev/null
## PHP
# Nginx
echo "Setting Up PHP Nginx Benchmarks"
docker-compose -f php/containers/nginx/docker-compose.yml build > /dev/null
docker-compose -f php/containers/nginx/docker-compose.yml up -d > /dev/null
echo "Running PHP Nginx wrk Benchmarks"
docker run --rm --network=host williamyeh/wrk $WRKTHREAD $WRKTIME $WRKCONN http://localhost:2929/ > $RESULTSDIR/results-php-nginx-root.txt
docker run --rm --network=host williamyeh/wrk $WRKTHREAD $WRKTIME $WRKCONN http://localhost:2929/concat > $RESULTSDIR/results-php-nginx-concat.txt
docker run --rm --network=host williamyeh/wrk $WRKTHREAD $WRKTIME $WRKCONN http://localhost:2929/counter > $RESULTSDIR/results-php-nginx-counter.txt
docker run --rm --network=host williamyeh/wrk $WRKTHREAD $WRKTIME $WRKCONN http://localhost:2929/arrayfill > $RESULTSDIR/results-php-nginx-arrayfill.txt
docker run --rm --network=host williamyeh/wrk $WRKTHREAD $WRKTIME $WRKCONN http://localhost:2929/mapfill > $RESULTSDIR/results-php-nginx-mapfill.txt
docker run --rm --network=host williamyeh/wrk $WRKTHREAD $WRKTIME $WRKCONN http://localhost:2929/jsondecode > $RESULTSDIR/results-php-nginx-jsondecode.txt
docker run --rm --network=host williamyeh/wrk $WRKTHREAD $WRKTIME $WRKCONN http://localhost:2929/fileread > $RESULTSDIR/results-php-nginx-fileread.txt
echo "Tearing Down PHP Nginx Benchmarks"
docker-compose -f php/containers/nginx/docker-compose.yml down > /dev/null
# Swoole
echo "Setting Up PHP Swoole Benchmarks"
docker-compose -f php/containers/swoole/docker-compose.yml build > /dev/null
docker-compose -f php/containers/swoole/docker-compose.yml up -d > /dev/null
echo "Running PHP Swoole wrk Benchmarks"
docker run --rm --network=host williamyeh/wrk $WRKTHREAD $WRKTIME $WRKCONN http://localhost:9900/ > $RESULTSDIR/results-php-swoole-root.txt
docker run --rm --network=host williamyeh/wrk $WRKTHREAD $WRKTIME $WRKCONN http://localhost:9900/concat > $RESULTSDIR/results-php-swoole-concat.txt
docker run --rm --network=host williamyeh/wrk $WRKTHREAD $WRKTIME $WRKCONN http://localhost:9900/counter > $RESULTSDIR/results-php-swoole-counter.txt
docker run --rm --network=host williamyeh/wrk $WRKTHREAD $WRKTIME $WRKCONN http://localhost:9900/arrayfill > $RESULTSDIR/results-php-swoole-arrayfill.txt
docker run --rm --network=host williamyeh/wrk $WRKTHREAD $WRKTIME $WRKCONN http://localhost:9900/mapfill > $RESULTSDIR/results-php-swoole-mapfill.txt
docker run --rm --network=host williamyeh/wrk $WRKTHREAD $WRKTIME $WRKCONN http://localhost:9900/jsondecode > $RESULTSDIR/results-php-swoole-jsondecode.txt
docker run --rm --network=host williamyeh/wrk $WRKTHREAD $WRKTIME $WRKCONN http://localhost:9900/fileread > $RESULTSDIR/results-php-swoole-fileread.txt
echo "Tearing Down PHP Swoole Benchmarks"
docker-compose -f php/containers/swoole/docker-compose.yml down > /dev/null

echo "Benchmarking Complete :)"
