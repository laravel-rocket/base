<?php

$finder = PhpCsFixer\Finder::create()
    ->notPath('bootstrap/cache')
    ->notPath('storage')
    ->notPath('vendor')
    ->in(__DIR__)
    ->name('*.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

$fixers = [
    '@PSR2'                                       => true,
    'no_closing_tag'                              => true,
    'blank_line_after_opening_tag'                => true,
    'concat_space'                                => true,
    'no_multiline_whitespace_around_double_arrow' => true,
    'no_empty_statement'                          => true,
    'simplified_null_return'                      => false,
    'include'                                     => true,
    'no_alias_functions'                          => true,
    'no_trailing_comma_in_list_call'              => true,
    'trailing_comma_in_multiline_array'           => true,
    'no_leading_namespace_whitespace'             => true,
    'linebreak_after_opening_tag'                 => true,
    'no_blank_lines_after_class_opening'          => true,
    'no_blank_lines_after_phpdoc'                 => true,
    'object_operator_without_whitespace'          => true,
    'phpdoc_indent'                               => true,
    'phpdoc_no_access'                            => true,
    'phpdoc_no_package'                           => true,
    'phpdoc_scalar'                               => true,
    'phpdoc_summary'                              => true,
    'phpdoc_to_comment'                           => true,
    'phpdoc_trim'                                 => true,
    'phpdoc_no_alias_tag'                         => ['type' => 'var'],
    'phpdoc_var_without_name'                     => true,
    'no_leading_import_slash'                     => true,
    'no_extra_consecutive_blank_lines'            => ['extra'],
    'blank_line_before_return'                    => true,
    'function_typehint_space'                     => true,
    'method_separation'                           => true,
    'no_unused_imports'                           => true,
    'ordered_imports'                             => true,
    'self_accessor'                               => true,
    'no_trailing_comma_in_singleline_array'       => true,
    'single_quote'                                => true,
    'no_singleline_whitespace_before_semicolons'  => true,
    'cast_spaces'                                 => true,
    'standardize_not_equals'                      => true,
    'ternary_operator_spaces'                     => true,
    'trim_array_spaces'                           => true,
    'binary_operator_spaces'                      => ['align_double_arrow' => true, 'align_equals' => true],
    'unary_operator_spaces'                       => true,
    'no_whitespace_in_blank_line'                 => true,
    'no_multiline_whitespace_before_semicolons'   => true,
    'array_syntax'                                => ['syntax' => 'short'],
    'no_short_echo_tag'                           => true,
    'hash_to_slash_comment'                       => true,
    'lowercase_cast'                              => true,
    'lowercase_constants'                         => true,
    'native_function_casing'                      => true,
    'no_blank_lines_before_namespace'             => true,
    'no_empty_comment'                            => true,
    'no_empty_phpdoc'                             => true,
    'no_short_bool_cast'                          => true,
    'no_spaces_around_offset'                     => true,
    'no_unneeded_control_parentheses'             => true,
    'no_whitespace_before_comma_in_array'         => true,
    'normalize_index_brace'                       => true,
    'phpdoc_align'                                => true,
    'phpdoc_separation'                           => true,
    'phpdoc_single_line_var_spacing'              => true,
    'phpdoc_types'                                => true,
    'return_type_declaration'                     => true,
    'short_scalar_cast'                           => true,
    'whitespace_after_comma_in_array'             => true,
];

return PhpCsFixer\Config::create()
    ->setRules($fixers)
    ->setRiskyAllowed(true)
    ->setUsingCache(true)
    ->setFinder($finder);
