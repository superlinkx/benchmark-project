package main

import (
	"benchmark-project/functions"
	"benchmark-project/lib"
	"flag"
	"fmt"
	"io/ioutil"
	"log"
	"os"
)

func main() {
	// Get Iterations
	var iterations int
	flag.IntVar(&iterations, "iter", 100, "Iterations to benchmark")
	flag.Parse()
	if iterations < 1 {
		iterations = 100
	}

	// Setup
	jsonData, err := ioutil.ReadFile("./data/demo.json")
	if err != nil {
		log.Fatalf("Error reading JSON file: %s", err.Error())
	}

	// Benchmark
	benchmark := lib.Benchmark{}
	benchmark.SetIter(iterations)
	benchmark.Add("Concatenate Strings", functions.Concat)
	benchmark.Add("Counter", functions.Counter)
	benchmark.Add("Array Fill", functions.Arrayfill)
	benchmark.Add("Map Fill", functions.Mapfill)
	benchmark.Add("JSON Parse", functions.Jsondecode, string(jsonData))
	benchmark.Add("File Read", functions.Fileread, "./data/demo.txt")
	benchmark.Run()

	// Write results to file
	resultsJSON := benchmark.GetJSON()
	f, err := os.OpenFile(fmt.Sprintf("/results/results-go-cli-%s.json", fmt.Sprint(iterations)), os.O_WRONLY|os.O_CREATE|os.O_TRUNC, 0644)
	if err != nil {
		log.Fatalf("Error opening JSON file for results: %s", err.Error())
	}
	_, err = f.Write(resultsJSON)
	if err != nil {
		log.Fatalf("Error writing JSON results file: %s", err.Error())
	}
}
