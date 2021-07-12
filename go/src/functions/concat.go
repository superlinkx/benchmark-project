package functions

import "strings"

func Concat(...string) interface{} {
	var str strings.Builder
	for i := 0; i < 1000; i++ {
		str.WriteString("Words\n")
	}
	return str.String()
}
