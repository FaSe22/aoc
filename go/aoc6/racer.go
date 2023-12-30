package aoc6

import (
	"fmt"
	"strconv"
	"strings"
)

func Parse(input string) [][]int {

	sanitized := strings.TrimSpace(strings.ReplaceAll(input, "Time:", ""))
	parts := strings.Split(sanitized, "Distance:")
	time := strings.Split(parts[0], " ")
	distance := strings.Split(parts[1], " ")
	var res [][]int
	for i := 0; i < len(time); i++ {
		if "" != time[i] {
			t, err := strconv.Atoi(time[i])
			d, err := strconv.Atoi(distance[i])
			if err != nil {
				fmt.Println("Error: ", err)
			}

			res = append(res, []int{t, d})
		}
	}

	return res
}

func CalculateDistances(time int) []int {

	var res []int

	for i := 0; i <= time; i++ {
		speed := i * 1
		rest := time - i
		res = append(res, speed*rest)
	}

	return res
}

func FilterResults(input []int, distance int) []int {
	var res []int
	for _, elem := range input {
		if elem > distance {
			res = append(res, elem)
		}
	}
	return res
}

func CalculateResult(input string) int {
	result := 1
	parsed := Parse(input)
	for _, parse := range parsed {
		distances := CalculateDistances(parse[0])
		res := FilterResults(distances, parse[1])
		result *= len(res)
	}
	return result

}
