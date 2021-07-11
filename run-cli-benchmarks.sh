#!/bin/bash
docker-compose -f node/docker-compose.yml build
docker-compose -f php/docker-compose.yml build
docker-compose -f node/docker-compose.yml up
docker-compose -f php/docker-compose.yml up