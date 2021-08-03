<?php

declare(strict_types=1);

namespace Mollie\PhpCodingStandards\PhpCsFixer;

/*
 * Last updated for php-cs-fixer version: 2.16
 */
class Rules
{
    public static function getForPhp71(array $overriddenRules = []): array
    {
        return array_merge(self::getBaseRules(), $overriddenRules);
    }

    public static function getForPhp72(array $overriddenRules = []): array
    {
        $specific72Rules = [
            // At the moment there are no specific 7.2 rules or configurations
        ];

        return array_merge(self::getForPhp71($specific72Rules), $overriddenRules);
    }

    public static function getForPhp73(array $overriddenRules = []): array
    {
        $specific73Rules = [
            'heredoc_indentation'   => true,
            'method_argument_space' => [
                'after_heredoc' => true,
                'on_multiline'  => 'ensure_fully_multiline',
            ],
            'no_whitespace_before_comma_in_array' => [
                'after_heredoc' => true,
            ],
        ];

        return array_merge(self::getForPhp72($specific73Rules), $overriddenRules);
    }

    private static function getBaseRules(): array
    {
        return [
            '@Symfony'                => true,
            'align_multiline_comment' => [
                'comment_type' => 'all_multiline',
            ],
            'array_indentation'      => true,
            'binary_operator_spaces' => [
                'default'   => 'single_space',
                'operators' => [
                    '=>' => 'align_single_space_minimal',
                ],
            ],
            'blank_line_before_statement' => [
                'statements' => [
                    'break', 'continue', 'case', 'declare', 'default', 'do', 'for', 'foreach',
                    'if', 'return', 'switch', 'throw', 'try', 'while', 'yield',
                ],
            ],
            'cast_spaces' => [
                'space' => 'none',
            ],
            'combine_consecutive_issets' => true,
            'combine_consecutive_unsets' => true,
            'combine_nested_dirname'     => true,
            'compact_nullable_typehint'  => true,
            'concat_space'               => [
                'spacing' => 'one',
            ],
            'dir_constant'                 => true,
            'escape_implicit_backslashes'  => true,
            'explicit_indirect_variable'   => true,
            'explicit_string_variable'     => true,
            'fully_qualified_strict_types' => true,
            'function_to_constant'         => true,
            'global_namespace_import'      => false,
            // 'header_comment'            => [ // Has too many issues atm
            //     'header' => '',
            // ],
            'increment_style' => [
                'style' => 'post',
            ],
            'is_null' => [
                'use_yoda_style' => false,
            ],
            'list_syntax' => [
                'syntax' => 'short',
            ],
            'magic_method_casing'   => true,
            'method_argument_space' => [
                'on_multiline' => 'ensure_fully_multiline',
            ],
            'method_chaining_indentation'             => true,
            'modernize_types_casting'                 => true,
            'multiline_comment_opening_closing'       => true,
            'multiline_whitespace_before_semicolons'  => true,
            'native_function_type_declaration_casing' => true,
            'no_alias_functions'                      => true,
            'no_alternative_syntax'                   => true,
            'no_extra_blank_lines'                    => [
                'tokens' => [
                    'break', 'case', 'continue', 'curly_brace_block', 'default', 'extra', 'parenthesis_brace_block',
                    'return', 'square_brace_block', 'throw', 'use_trait',
                    // TODO: Add 'use' when php-cs-fixer #3582 is fixed
                ],
            ],
            'no_null_property_initialization'                  => true,
            'no_superfluous_elseif'                            => true,
            'no_superfluous_phpdoc_tags'                       => true,
            'no_unset_cast'                                    => true,
            'no_unset_on_property'                             => false, // It's purposely used for the side effect :(
            'no_useless_else'                                  => true,
            'no_useless_return'                                => true,
            'nullable_type_declaration_for_default_null_value' => true,
            'ordered_class_elements'                           => [
                'order' => [
                    'use_trait',
                    'constant_public', 'constant_protected', 'constant_private',
                    'property_public', 'property_protected', 'property_private',
                    // Not shuffling methods. I'd love to do it but I think it's too much for most people.
                ],
            ],
            'ordered_imports' => [
                'imports_order' => ['class', 'function', 'const'],
            ],
            'phpdoc_line_span' => [
                'const'    => 'single',
                'method'   => 'multi',
                'property' => 'single',
            ],
            'phpdoc_no_empty_return'                 => true,
            'php_unit_construct'                     => true,
            'php_unit_dedicate_assert_internal_type' => true,
            'php_unit_method_casing'                 => true,
            'php_unit_test_case_static_method_calls' => [
                'call_type' => 'self',
            ],
            'phpdoc_annotation_without_dot' => false, // Sometimes comments have a good reason to end with a dot. Leave this up to the engineer.
            'phpdoc_no_alias_tag'           => [
                'replacements' => [
                    'link' => 'see',
                    'type' => 'var',
                ],
            ],
            'phpdoc_order'                                  => true,
            'phpdoc_summary'                                => false, // Sometimes comments have a good reason not to end with a dot. Leave this up to the engineer.
            'phpdoc_to_comment'                             => false, // We use more annotations than only structural elements (f.e. @lang JSON)
            'phpdoc_trim_consecutive_blank_line_separation' => true,
            'phpdoc_types_order'                            => [
                'null_adjustment' => 'always_last',
            ],
            'phpdoc_var_annotation_correct_order' => true,
            'pow_to_exponentiation'               => true,
            'return_assignment'                   => true,
            'simple_to_complex_string_variable'   => true,
            'simplified_null_return'              => false, // Too many old code places that become implicit, also ignores doc blocks.
            'single_class_element_per_statement'  => true,
            'single_line_throw'                   => false,
            'single_quote'                        => false,
            'single_trait_insert_per_statement'   => true,
            'space_after_semicolon'               => [
                'remove_in_empty_for_expressions' => true,
            ],
            'ternary_to_null_coalescing' => true,
            'visibility_required'        => [
                'elements' => [
                    'const', 'method', 'property',
                ],
            ],
            'yoda_style' => [
                'equal'            => false,
                'identical'        => false,
                'less_and_greater' => false,
            ],
        ];
    }
}
