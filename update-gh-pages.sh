#!/bin/sh

./generate.sh

cd codeigniter-jp.github.io

git checkout master
rm -rf user_guide/3/*
cp -r ../user_guide_src_ja/build/html/* user_guide/3/

git add --all
git commit -m "Update GitHub Pages user_guide/3"

echo
echo "To update GitHub Pages, type the following commands:"
echo "  cd codeigniter-jp.github.io/"
echo "  git push origin master"

