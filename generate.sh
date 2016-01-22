#!/bin/sh

cd user_guide_src_ja/
git checkout develop_japanese
make clean
make html
cd ../
php cmd.php add:link

echo
echo "Open user_guide_src_ja/build/html/index.html"
