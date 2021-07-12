package lib

import (
	"encoding/json"
	"fmt"
	"log"
	"runtime"
	"time"
)

type benchmarkResult struct {
	MemUsed    map[string]uint64 `json:"memUsed"`
	RawTimings []time.Duration   `json:"rawTimings"`
	Average    string            `json:"average"`
}

type benchmarkContainer struct {
	name      string
	benchmark func(...string) interface{}
	params    []string
}

type Benchmark struct {
	iterations int
	benchmarks []benchmarkContainer
	results    map[string]benchmarkResult
}

func (b *Benchmark) runBenchmark(benchmark benchmarkContainer) benchmarkResult {
	var m runtime.MemStats
	var rawTimings []time.Duration
	for i := 0; i < b.iterations; i++ {
		start := time.Now()
		benchmark.benchmark(benchmark.params...)
		cpuTime := time.Since(start)
		rawTimings = append(rawTimings, cpuTime)
	}
	runtime.ReadMemStats(&m)
	memUsed := make(map[string]uint64)
	memUsed["heapUsed"] = m.Alloc
	memUsed["heapTotal"] = m.TotalAlloc
	average := b.calculateAverage(rawTimings)
	return benchmarkResult{
		MemUsed:    memUsed,
		RawTimings: rawTimings,
		Average:    average,
	}
}

func (b *Benchmark) calculateAverage(timings []time.Duration) string {
	var totalTime time.Duration
	for _, timing := range timings {
		totalTime += timing
	}
	average := float64(totalTime) / float64(b.iterations) / float64(1000)
	return fmt.Sprintf("%.3f", average)
}

func (b *Benchmark) SetIter(iterations int) {
	b.iterations = iterations
}

func (b *Benchmark) Add(name string, benchmark func(...string) interface{}, params ...string) {
	thisBenchmark := benchmarkContainer{name: name, benchmark: benchmark, params: params}
	b.benchmarks = append(b.benchmarks, thisBenchmark)
}

func (b *Benchmark) Run() {
	b.results = make(map[string]benchmarkResult)
	for _, benchmark := range b.benchmarks {
		fmt.Printf("Running benchmark %s...\n", benchmark.name)
		b.results[benchmark.name] = b.runBenchmark(benchmark)
		heapTotalMB := float64(b.results[benchmark.name].MemUsed["heapTotal"]) / (float64(1024 * 1024))
		heapUsedMB := float64(b.results[benchmark.name].MemUsed["heapUsed"]) / (float64(1024 * 1024))
		fmt.Printf("Direct Time Average: %sµs\n", b.results[benchmark.name].Average)
		fmt.Printf(
			"Memory Usage: (heapTotal: %sMB, heapUsed: %sMB)\n",
			fmt.Sprintf("%.6f", heapTotalMB),
			fmt.Sprintf("%.6f", heapUsedMB),
		)
	}
}

func (b *Benchmark) GetJSON() []byte {
	results, err := json.Marshal(b.results)
	if err != nil {
		log.Fatalf("Error while marshalling JSON results: %s", err.Error())
	}
	return results
}
