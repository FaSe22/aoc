#1abc2
#pqr3stu8vwx
#a1b2c3d4e5f
#treb7uchet

#!/bin/bash
func1(){
  p1=$(echo $1 | sed ' s/[^[:digit:]]//g' | cut -c 1 )
  p2=$(echo $1 | sed ' s/[^[:digit:]]//g' | rev | cut -c 1 )
  echo $p1$p2
}

func1 $1
