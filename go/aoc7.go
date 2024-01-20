package aoc7

import (
	"bufio"
	"fmt"
	"log"
	"os"
	"sort"
	"strconv"
	"strings"
)

func main() {
	fmt.Println(Eval())
}

type Hand struct {
	cards string
	bid   int
	rank  int
}

var values = map[byte]int{
	'A': 14,
	'K': 13,
	'Q': 12,
	'J': 11,
	'T': 10,
	'9': 9,
	'8': 8,
	'7': 7,
	'6': 6,
	'5': 5,
	'4': 4,
	'3': 3,
	'2': 2,
}

func Eval() int {
	hands := Parse()
	res := 0
	for i := 0; i < len(hands); i++ {
		res += hands[i].bid * (i + 1)
	}
	return res
}

func Parse() []Hand {
	hands := []Hand{}
	f, err := os.Open("input.txt")

	if err != nil {
		log.Fatal(err)
	}

	defer f.Close()

	scanner := bufio.NewScanner(f)

	for scanner.Scan() {

		split := strings.Split(scanner.Text(), " ")
		bid, err := strconv.Atoi(split[1])
		if err != nil {
			panic(err)
		}
		hands = append(hands, Hand{cards: split[0], bid: bid, rank: EvalHand(split[0])})
	}

	sort.Slice(hands, func(i, j int) bool {
		if hands[i].rank == hands[j].rank {
			for v := range hands[i].cards {
				if hands[i].cards[v] == hands[j].cards[v] {
					continue
				}
				return values[hands[i].cards[v]] < values[hands[j].cards[v]]
			}

		}
		return hands[i].rank < hands[j].rank
	})

	return hands
}

const (
	FIVE_OF_A_KIND  = 7
	FOUR_OF_A_KIND  = 6
	FULL_HOUSE      = 5
	THREE_OF_A_KIND = 4
	TWO_PAIR        = 3
	ONE_PAIR        = 2
	HIGH_CARD       = 1
)

func EvalHand(hand string) int {
	cards := map[rune]int{}
	for _, v := range hand {
		cards[v] += 1
	}

	if len(cards) == 1 {
		return FIVE_OF_A_KIND
	}

	if len(cards) == 2 {
		for _, v := range cards {
			if v == 4 {
				return FOUR_OF_A_KIND
			}
		}
		return FULL_HOUSE
	}

	if len(cards) == 3 {
		for _, v := range cards {
			if v == 3 {
				return THREE_OF_A_KIND
			}
		}
		return TWO_PAIR

	}

	if len(cards) == 5 {
		return HIGH_CARD
	}

	return ONE_PAIR
}
