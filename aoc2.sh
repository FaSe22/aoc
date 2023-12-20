#!/bin/bash


func1(){

matches[0]="Game 1: 3 blue, 4 red, 1 red, 2 green, 6 blue, 2 green"
matches[1]="Game 2: 1 blue, 2 green, 3 green, 4 blue, 1 red, 1 green, 1 blue"
matches[3]="Game 3: 8 green, 6 blue, 20 red, 5 blue, 4 red, 13 green, 5 green, 1 red"
matches[4]="Game 4: 1 green, 3 red, 6 blue; 3 green, 6 red; 3 green, 15 blue, 14 red"
matches[5]="Game 5: 6 red, 1 blue, 3 green, 2 blue, 1 red, 2 green"

for game in "${matches}"; do
g=$(echo $(echo "$game" | sed 's/Game [[:digit:]]://g'))
echo "$g"
id=$(echo $(echo "$game" | grep -o "Game [[:digit:]]:" | grep -o "[[:digit:]]"))
while IFS=',' read -ra ADDR; do
  for i in "${ADDR[@]}"; do
    for j in "${matches}"; do
      type1=$(echo $(echo $i |  grep -o "[^[:digit:]]*")) 
      num1=$(echo $(echo $i |  grep -o "[[:digit:]]*")) 
      values=$(echo $(echo $j |  grep -o "[^[:digit:]]*")) 
      values2=$(echo $(echo $j |  grep -o "[[:digit:]]*")) 
      for value in "${values}"; do
        for value2 in "${values2}"; do
          echo "$value"
          echo "$value2"
      if [ $num1 -ge $value2 ] && [ $type1 == $value ]
        then echo false
        else echo "$id"
      fi
    done
    done
    done
  done
done <<< $g
done

#"12 red  13 green  14 blue"

}


func1 "12 red, 13 green, 14 blue"
