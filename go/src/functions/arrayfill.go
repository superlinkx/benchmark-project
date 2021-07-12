package functions

func Arrayfill(...string) interface{} {
	var arr []string
	for i := 0; i < 1000; i++ {
		arr = append(arr, "Words\n")
	}
	return arr
}
