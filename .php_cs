<?php

$finder = Symfony\CS\Finder\DefaultFinder::create()
    ->in('src/')
    ->in('tests/')
;

return Symfony\CS\Config\Config::create()
    ->level(Symfony\CS\FixerInterface::SYMFONY_LEVEL)
    ->fixers(array(
        '-unalign_double_arrow',
        '-unalign_equals',
	    '-phpdoc_to_comment',
        'align_double_arrow',
        'align_equals',
        'newline_after_open_tag',
        'unused_use',
        'ordered_use',
        'linefeed',
        'concat_with_spaces',
        'short_array_syntax',
        'phpdoc_order'
    ))
    ->setUsingCache(true)
    ->finder($finder)
;