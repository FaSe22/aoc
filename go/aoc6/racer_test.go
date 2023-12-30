package aoc6

import (
	"reflect"
	"testing"
)

func TestParse(t *testing.T) {
	input := "Time:      7  15   30 Distance:  9  40  200"
	expected_result := [][]int{
		{7, 9},
		{15, 40},
		{30, 200},
	}

	res := Parse(input)
	if !reflect.DeepEqual(expected_result, res) {
		t.Errorf("expected %d found %d", expected_result, res)
	}
}
