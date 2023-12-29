#!/bin/bash
#https://adventofcode.com/2023/day/5
#

#seed-to-soil map:
s2s=(
"50,98,2" "52,50,48"
)

map(){
#echo $1
map=$2

IFS="," read -ra TRIPLE <<< "$2"
destination="${TRIPLE[0]}"
source="${TRIPLE[1]}"
range="${TRIPLE[2]}"
destination_end=$((destination+range))
source_end=$((source+range))
count=0

if (( $1 >= $source_end || $1 < $source)) 
then
  echo "$1" "=>" "$1"
  continue
fi

for ((i=source; i<source_end; i++))
do
    if (( $1 < $source_end && $1 > $source)) 
    then
      if (($1 == $((source+count))))
      then
        echo $1 "=>" $((destination+count))
      fi
    else
      echo $1 "=>" $1
    fi
    (( count++ ))
done

}

map 79 "50,98,2"
map 79 "52,50,48"
map 14 "50,98,2"
map 14 "52,50,48"
map 57 "50,98,2"
map 57 "52,50,48"

#inArray(){
#  start=$1
#  range=$2
#  end=$((start+range))
#  num=$3
#  res=0
#  
#  if (( $num > $start && $num < $end )) 
#    then
#      for i in $(seq $start $end); do 
#        if (( $i == $num ))
#          then 
#            echo "hi";
#        fi
#    done
#  fi
#}
#
#inArray 1 10 3
#inArray 1 10 30
#
## map 79 $s2s
