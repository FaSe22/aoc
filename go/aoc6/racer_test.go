package aoc6

import (
	"reflect"
	"testing"
)

func TestParse(t *testing.T) {
	input := "Time:7 15 30 Distance:9 40 200"
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

func TestCalculateDistances(t *testing.T) {
	input := 7
	expected_result := []int{
		0, 6, 10, 12, 12, 10, 6, 0,
	}

	res := CalculateDistances(input)

	if res[3] != expected_result[3] {
		t.Errorf("expected %d found %d", expected_result, res)
	}
}

func TestFilterResults(t *testing.T) {
	input := []int{0, 6, 10, 12, 12, 10, 6, 0}
	expected_result := []int{10, 12, 12, 10}

	res := FilterResults(input, 9)
	if !reflect.DeepEqual(expected_result, res) {
		t.Errorf("expected %d found %d", expected_result, res)
	}
}

func TestCalculateResult(t *testing.T) {
	input := "Time:7 15 30 Distance:9 40 200"
	expected_result := 288

	res := CalculateResult(input)
	if res != expected_result {
		t.Errorf("expected %d found %d", expected_result, res)
	}
}
