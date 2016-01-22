#!/bin/sh

cd user_guide_src_ja/
git checkout develop_japanese
make clean
make html
cd ../
php cmd.php add:link

cp -p user_guide_src_ja/CREDITS.md user_guide_src_ja/build/html/
cp -p user_guide_src_ja/LICENSE.md user_guide_src_ja/build/html/

echo
echo "Open user_guide_src_ja/build/html/index.html"
