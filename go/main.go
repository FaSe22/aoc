package main

import (
	"aoc/aoc6"
	"fmt"
)

func main() {

	//seeds := []int{
	//	2019933646, 2719986, 2982244904, 337763798, 445440, 255553492, 1676917594, 196488200, 3863266382, 36104375, 1385433279, 178385087, 2169075746, 171590090, 572674563, 5944769, 835041333, 194256900, 664827176, 42427020,
	//}

	//mapper := aoc5.GetLocation(seeds)
	//fmt.Println(mapper)

	races := "Time:40 81 77 72 Distance:219 1012 1365 1089"
	res := aoc6.CalculateResult(races)
	fmt.Println(res)
}
