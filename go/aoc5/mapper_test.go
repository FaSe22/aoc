package aoc5

import (
	"testing"
)

func TestApplyMappings(t *testing.T) {

	var seed_2_soil = [][]int{
		{50, 98, 2},
		{52, 50, 48},
	}

	var soil_2_fertilizer = [][]int{
		{0, 15, 37},
		{37, 52, 2},
		{39, 0, 15},
	}

	var fertilizer_2_water = [][]int{
		{49, 53, 8},
		{0, 11, 42},
		{42, 0, 7},
		{57, 7, 4},
	}

	var water_2_light = [][]int{
		{88, 18, 7},
		{18, 25, 70},
	}

	var light_2_temp = [][]int{
		{45, 77, 23},
		{81, 45, 19},
		{68, 64, 13},
	}

	var humidity_2_location = [][]int{
		{60, 56, 37},
		{56, 93, 4},
	}

	var temp_2_humidity = [][]int{
		{0, 69, 1},
		{1, 0, 69},
	}

	testCases := []struct {
		seed     int
		mappings [][]int
		want     int
	}{
		{79, seed_2_soil, 81},
		{14, seed_2_soil, 14},
		{55, seed_2_soil, 57},
		{13, seed_2_soil, 13},
		{81, soil_2_fertilizer, 81},
		{57, soil_2_fertilizer, 57},
		{14, soil_2_fertilizer, 53},
		{13, soil_2_fertilizer, 52},
		{81, fertilizer_2_water, 81},
		{53, fertilizer_2_water, 49},
		{57, fertilizer_2_water, 53},
		{52, fertilizer_2_water, 41},
		{81, water_2_light, 74},
		{49, water_2_light, 42},
		{53, water_2_light, 46},
		{41, water_2_light, 34},
		{74, light_2_temp, 78},
		{78, temp_2_humidity, 78},
		{78, humidity_2_location, 82},
	}

	for _, testCase := range testCases {
		res := ApplyMappings(testCase.seed, testCase.mappings)
		if res != testCase.want {
			t.Errorf("expected %d got %d", testCase.want, res)
		}

	}

}

func TestMap(t *testing.T) {

	testCases := []struct {
		seed int
		want int
	}{
		{79, 82},
		{14, 43},
		{55, 86},
		{13, 35},
	}

	for _, testCase := range testCases {
		res := Map(testCase.seed)
		if res != testCase.want {
			t.Errorf("expected %d got %d", testCase.want, res)
		}

	}

}

func TestLocation(t *testing.T) {
	var seeds = []int{
		79,
		14,
		55,
		13,
	}
	res := GetLocation(seeds)
	if res != 35 {
		t.Errorf("expected 35 got %d", res)
	}

}
