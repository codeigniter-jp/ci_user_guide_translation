# Translation Tools for CodeIgniter User Guide

## Folder Structure

~~~
ci_user_guide_translation/
├── CodeIgniter/              ... The offical CodeIgniter repository
├── codeigniter-jp.github.io/ ... The GitHub page repository for CodeIgniter Users Group in Japan
├── user_guide_src_en/        ... The repository containing only the offical User Guide
└── user_guide_src_ja/        ... The repository for Japanese User Guide
~~~

## Installation

~~~
$ git clone git@github.com:codeigniter-jp/ci_user_guide_translation.git
$ cd ci_user_guide_translation/
$ ./init.sh
$ composer install
~~~

## How to Update `develop` branch

The following commands update `develop` branch in `user_guide_src_ja`.

~~~
$ cd ci_user_guide_translation/
$ ./update-develop.sh
~~~

## How to Generate Japanese HTML

Before generating HTML, you must set up Sphinx. See <https://github.com/bcit-ci/CodeIgniter/blob/develop/user_guide_src/README.rst>.

~~~
$ sudo easy_install "sphinx==1.2.3"
$ sudo easy_install sphinxcontrib-phpdomain
$ cd ci_user_guide_translation/CodeIgniter/user_guide_src/cilexer/
$ sudo python setup.py install
~~~

Confirm the installation. You should see *CodeIgniter*:

~~~
$ pygmentize -L | grep -i codeigniter
* ci, codeigniter:
    CodeIgniter (filenames *.html, *.css, *.php, *.xml, *.static)
~~~

Now you can generate HTML files.

~~~
$ cd ci_user_guide_translation/
$ ./generate.sh
~~~

Open `user_guide_src_ja/build/html/index.html`.

## References

* https://github.com/bcit-ci/CodeIgniter/tree/develop/user_guide_src
* https://github.com/codeigniter-jp/user_guide_src_ja
