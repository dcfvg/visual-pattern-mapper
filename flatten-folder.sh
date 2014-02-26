#!/bin/bash
#set -x
dir=$1
for img in `find $dir -iname "*.jpg" -type f`
do
  img_id=$(basename $(dirname $img))
  img_name=$(basename $img)
  set_name=$(basename $(dirname $(dirname $img)))
  
  target_dir="assets/exp-$set_name"
  target_file=$target_dir"/"$img_id"_"$img_name
  
  mkdir $target_dir
  cp -v $img $target_file 
done

# sudo chown -R _www $assets