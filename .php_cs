<?php

$finder = Symfony\Component\Finder\Finder::create()
    ->notPath('vendor')
    ->in(__DIR__)
    ->name('*.php')
    ->notName('*.blade.php');

return PhpCsFixer\Config::create()
    ->setRules([
        'psr0' => false,
        '@PSR2' => true,
        'array_indentation' => true,
        'array_syntax' => [
            'syntax' => 'short'
        ],
        'blank_line_after_opening_tag' => true,
        'method_argument_space' => [
            'on_multiline' => 'ensure_fully_multiline',
        ],
        'method_chaining_indentation' => true,
        'no_unused_imports' => true,
        'not_operator_with_successor_space' => true,
        'ordered_imports' => [
            'sortAlgorithm' => 'alpha'
        ],
        'single_blank_line_before_namespace' => true,
        'trailing_comma_in_multiline_array' => true,
        'binary_operator_spaces' => [
            'operators' => [
                '=>' => 'align'
            ],
            'default' => null,
        ],
    ])
    ->setLineEnding("\n")
    ->setFinder($finder);
