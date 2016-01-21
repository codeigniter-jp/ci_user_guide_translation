#!/bin/sh

if [ $# -eq 0 ]; then
        echo "meld ci-ja/user_guide_ja_src/source user_guide_src_ja/source"
        echo " usage: $0 file"
        echo "    eg: $0 tutorial/static_pages"
        exit;
fi

file="$1"
meld "./ci-ja/user_guide_ja_src/source/$file.rst" "./user_guide_src_ja/source/$file.rst" &
