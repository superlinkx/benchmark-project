package functions

import "fmt"

func Mapfill(...string) interface{} {
	associativeMap := make(map[string]string)
	for i := 0; i < 1000; i++ {
		associativeMap["word"+fmt.Sprint(i)] = "Word\n"
	}
	return associativeMap
}
