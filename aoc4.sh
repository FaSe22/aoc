#!/bin/bash
array=(
"Card 1: 41 48 83 86 17 | 83 86  6 31 17  9 48 53"
"Card 2: 13 32 20 16 61 | 61 30 68 82 17 32 24 19"
"Card 3:  1 21 53 59 44 | 69 82 63 72 16 21 14  1"
"Card 4: 41 92 73 84 69 | 59 84 76 51 58  5 54 83"
"Card 5: 87 83 26 28 32 | 88 30 70 12 93 22 82 36"
"Card 6: 31 18 13 56 72 | 74 77 10 23 35 67 36 11"
)

sum=0;
for input_string in "${array[@]}"; 
do
sanitized=${input_string#*Card 1: } 
left_of_pipe=${sanitized%|*} 
right_of_pipe=${input_string#*| }

left_array=($left_of_pipe)
right_array=($right_of_pipe)

# sortier mir die, damit ich vergleichen kann
left_sorted=$(mktemp)
right_sorted=$(mktemp)
echo "${left_array[@]}" | tr ' ' '\n' | sort > "$left_sorted"
echo "${right_array[@]}" | tr ' ' '\n' | sort > "$right_sorted"

# comm = findet überschneidungen!! -12 = 1. file + 2. file 
intersection=$(comm -12 "$left_sorted" "$right_sorted" )

multiplier=0

for i in $intersection; do
  if [[ $multiplier == 0 ]]; then
    multiplier=1
    continue
  else
    ((multiplier *= 2))
  fi
done;

((sum+=$multiplier));
done;

echo "$sum"
