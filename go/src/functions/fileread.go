package functions

import "io/ioutil"

func Fileread(params ...string) interface{} {
	content, _ := ioutil.ReadFile(params[0])
	return content
}
