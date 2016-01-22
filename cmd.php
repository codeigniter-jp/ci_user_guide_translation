<?php
/**
 * Translation Tools
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2016 Kenji Suzuki
 * @link       https://github.com/codeigniter-jp/ci_user_guide_translation
 */

$en_dir = __DIR__ . '/user_guide_src_en/source';
$ja_dir = __DIR__ . '/user_guide_src_ja/source';

require __DIR__ . '/vendor/autoload.php';

mb_internal_encoding('UTF-8');

if (! isset($argv[1])) {
    echo 'Usage:', PHP_EOL;
    echo '  php ', $argv[0] . ' check:line' . PHP_EOL;
    echo '  php ', $argv[0] . ' add:link' . PHP_EOL;
    exit(1);
}

$cmd = $argv[1];

switch ($cmd) {
    case 'check:line':
        $docs_en = new \Kenjis\TranslationTools\Document($en_dir, 'rst');
        $docs_ja = new \Kenjis\TranslationTools\Document($ja_dir, 'rst');
        $commandObject = new Kenjis\TranslationTools\Command\CheckLineCount();
        $commandObject->check($docs_en, $docs_ja);
        break;
    case 'add:link':
        $ja_html = __DIR__ . '/user_guide_src_ja/build/html';
        $html_ja = new Kenjis\TranslationTools\Document($ja_html, 'html');
        $commandObject = new Kenjis\TranslationTools\Command\AddGitHubLinks();
        $commandObject->add($html_ja);
        break;
    default:
        echo 'No such command: ', $cmd, PHP_EOL;
        exit(1);
}
