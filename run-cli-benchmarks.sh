#!/bin/bash
docker-compose -f node/containers/cli/docker-compose.yml build
docker-compose -f php/containers/cli/docker-compose.yml build
docker-compose -f node/containers/cli/docker-compose.yml up
docker-compose -f php/containers/cli/docker-compose.yml up