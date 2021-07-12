package functions

func Counter(...string) interface{} {
	count := 0
	for i := 0; i < 1000; i++ {
		count++
	}
	return count
}
