#!/bin/sh

if [ $# -eq 0 ]; then
        echo "meld user_guide_src_en/source user_guide_src_ja/source"
        echo " usage: $0 file"
        echo "    eg: $0 tutorial/static_pages"
        exit;
fi

file="$1"
meld "./user_guide_src_en/source/$file.rst" "./user_guide_src_ja/source/$file.rst" &
