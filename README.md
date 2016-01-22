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

Before generating HTML, you must set up Sphinx. See <https://github.com/bcit-ci/CodeIgniter/blob/develop/user_guide_src/README.rst>.

~~~
$ cd ci_user_guide_translation/
$ ./generate.sh
~~~

Open `user_guide_src_ja/build/html/index.html`.

## References

* https://github.com/bcit-ci/CodeIgniter/tree/develop/user_guide_src
* https://github.com/codeigniter-jp/user_guide_src_ja
