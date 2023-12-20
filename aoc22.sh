#!/bin/bash

matches="Game 1: 3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green 
Game 2: 1 blue, 2 green; 3 green, 4 blue, 1 red; 1 green, 1 blue
Game 3: 8 green, 6 blue, 20 red, 5 blue, 4 red, 13 green, 5 green, 1 red
Game 4: 1 green, 3 red, 6 blue; 3 green, 6 red; 3 green, 15 blue, 14 red 
Game 5: 6 red, 1 blue, 3 green; 2 blue, 1 red, 2 green"

#only 12 red cubes, 13 green cubes, and 14 blue cubes?
replaced=$(echo "$matches" | sed "s/ red/ < 12/g" | sed "s/ blue/ < 14/g" | sed "s/ green/ < 13/g")

result=0
while IFS=';,' read -ra expressions; do
  count=0
  index=0
for expr in "${expressions[@]}"; do
  echo "$expr"
  expr=$(echo "$expr"  | sed 's/Game [[:digit:]]: //g' )
  if ((expr)); then
    continue
  else
    ((count++))
  fi
done
  id=$(echo "${expressions[$index]}" | grep -o 'Game [0-9]\+' | sed 's/Game //') 
  if ((count == 0)); then
    ((result += $id))
  fi
  ((index++))
echo "$result"
done  <<< "$(echo "$replaced")"

