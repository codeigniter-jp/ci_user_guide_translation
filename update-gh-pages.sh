#!/bin/sh

./generate.sh

rm -rf html/
mv user_guide_src_ja/build/html/ .

cd user_guide_src_ja/

#git checkout --orphan gh-pages
#git rm -r --cached .
#rm -rf * .gitignore
#touch .nojekyll

git checkout gh-pages
rm -rf *
mv ../html/ .
mv html/* .
mv html/.buildinfo .
rmdir html/

git add --all
git commit -m "Update GitHub Pages"

echo
echo "To update GitHub Pages, type the following commands:"
echo "  cd user_guide_src_ja/"
echo "  git push origin gh-pages"
