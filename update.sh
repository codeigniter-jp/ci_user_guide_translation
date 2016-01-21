#!/bin/sh

cd CodeIgniter
git fetch origin
git checkout develop
git merge origin/develop

# Create git repo only containing user_guide_src/
rm -rf user_guide_src_en
git clone CodeIgniter user_guide_src_en
cd user_guide_src_en
git filter-branch --prune-empty --subdirectory-filter user_guide_src develop

cd ../user_guide_src_ja
git fetch origin
git checkout develop
git merge origin/develop
