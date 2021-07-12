package functions

import "encoding/json"

func Jsondecode(params ...string) interface{} {
	var data map[string]interface{}
	_ = json.Unmarshal([]byte(params[0]), &data)
	return data
}
