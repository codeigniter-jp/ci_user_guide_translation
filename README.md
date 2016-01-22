# Translation Tools for CodeIgniter User Guide

## Installation

~~~
$ git clone git@github.com:codeigniter-jp/ci_user_guide_translation.git
$ cd ci_user_guide_translation/
$ ./init.sh
$ composer install
~~~

## How to Update `develop` branch

~~~
$ cd ci_user_guide_translation/
$ ./update.sh
~~~

## How to Generate Japanese HTML

~~~
$ cd ci_user_guide_translation/
$ cd user_guide_src_ja/
$ make clean
$ make html
$ cd ../
$ php cmd.php add:link
~~~

Open `user_guide_src_ja/build/html/index.html`.
