#!/bin/sh

git clone git@github.com:bcit-ci/CodeIgniter.git

# Create git repo only containing user_guide_src/
rm -rf user_guide_src_en
git clone CodeIgniter user_guide_src_en
cd user_guide_src_en/
git filter-branch --prune-empty --subdirectory-filter user_guide_src develop

cd ../
git clone git@github.com:codeigniter-jp/user_guide_src_ja.git

cd user_guide_src_ja/
git checkout -b develop --track origin/develop
git remote add en ../user_guide_src_en/
git remote add nekoget git@github.com:NEKOGET/ci_user_guide_src.git
git fetch nekoget
