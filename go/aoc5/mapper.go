package aoc5

func GetLocation(seeds []int) int {
	var num = 100
	for _, seed := range seeds {
		res := Map(seed)
		if res < num {
			num = res
		}

	}
	return num
}

func Map(seed int) int {
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

	return ApplyMappings(
		ApplyMappings(
			ApplyMappings(
				ApplyMappings(
					ApplyMappings(
						ApplyMappings(
							ApplyMappings(seed, seed_2_soil),
							soil_2_fertilizer),
						fertilizer_2_water),
					water_2_light),
				light_2_temp),
			temp_2_humidity),
		humidity_2_location)

}

func ApplyMappings(input int, mappings [][]int) int {
	for _, mapping := range mappings {
		var source_range_start = mapping[1]
		var r = mapping[2]
		var source_range_end = source_range_start + r

		var counter = 0
		for i := source_range_start; i < source_range_end; i++ {
			if input == i {
				return mapping[0] + counter
			}
			counter++
		}
	}
	return input
}
