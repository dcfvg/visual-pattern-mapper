#!/bin/bash
#set -x
name=$1
row=$2
col=$3

assets="assets/"
maps="$assets/maps/"
newpath=$maps"/$name/"

mkdir -v $newpath

for (( r = 0; r < row; r++ )); do
  for (( c = 0; c < col; c++ )); do
    mkdir -v $newpath"/$r-$c"
  done
done

# sudo chown -R _www $assets