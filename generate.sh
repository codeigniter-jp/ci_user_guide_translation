#!/bin/sh

cd user_guide_src_ja/
git checkout develop_japanese
make clean
make html
cp -p CREDITS.md build/html/
cp -p LICENSE.md build/html/

cd ../
php cmd.php add:link

echo
echo "Open user_guide_src_ja/build/html/index.html"
