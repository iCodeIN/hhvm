/**
 * Copyright (c) 2016, Facebook, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the "hack" directory of this source tree. An additional
 * directory.
 *
 **
 *
 * THIS FILE IS @generated; DO NOT EDIT IT
 * To regenerate this file, run
 *
 *   buck run //hphp/hack/src:generate_full_fidelity
 *
 **
 *
 */

use ocamlrep_derive::{FromOcamlRep, ToOcamlRep};

use crate::token_kind::TokenKind;

#[derive(Debug, Copy, Clone, FromOcamlRep, ToOcamlRep, PartialEq)]
pub enum SyntaxKind {
    Missing,
    Token(TokenKind),
    SyntaxList,
    EndOfFile,
    Script,
    QualifiedName,
    SimpleTypeSpecifier,
    LiteralExpression,
    PrefixedStringExpression,
    VariableExpression,
    PipeVariableExpression,
    FileAttributeSpecification,
    EnumDeclaration,
    Enumerator,
    RecordDeclaration,
    RecordField,
    AliasDeclaration,
    PropertyDeclaration,
    PropertyDeclarator,
    NamespaceDeclaration,
    NamespaceDeclarationHeader,
    NamespaceBody,
    NamespaceEmptyBody,
    NamespaceUseDeclaration,
    NamespaceGroupUseDeclaration,
    NamespaceUseClause,
    FunctionDeclaration,
    FunctionDeclarationHeader,
    WhereClause,
    WhereConstraint,
    MethodishDeclaration,
    MethodishTraitResolution,
    ClassishDeclaration,
    ClassishBody,
    TraitUsePrecedenceItem,
    TraitUseAliasItem,
    TraitUseConflictResolution,
    TraitUse,
    RequireClause,
    ConstDeclaration,
    ConstantDeclarator,
    TypeConstDeclaration,
    DecoratedExpression,
    ParameterDeclaration,
    VariadicParameter,
    OldAttributeSpecification,
    AttributeSpecification,
    Attribute,
    InclusionExpression,
    InclusionDirective,
    CompoundStatement,
    ExpressionStatement,
    MarkupSection,
    MarkupSuffix,
    UnsetStatement,
    UsingStatementBlockScoped,
    UsingStatementFunctionScoped,
    WhileStatement,
    IfStatement,
    ElseifClause,
    ElseClause,
    TryStatement,
    CatchClause,
    FinallyClause,
    DoStatement,
    ForStatement,
    ForeachStatement,
    SwitchStatement,
    SwitchSection,
    SwitchFallthrough,
    CaseLabel,
    DefaultLabel,
    ReturnStatement,
    GotoLabel,
    GotoStatement,
    ThrowStatement,
    BreakStatement,
    ContinueStatement,
    EchoStatement,
    ConcurrentStatement,
    SimpleInitializer,
    AnonymousClass,
    AnonymousFunction,
    AnonymousFunctionUseClause,
    LambdaExpression,
    LambdaSignature,
    CastExpression,
    ScopeResolutionExpression,
    MemberSelectionExpression,
    SafeMemberSelectionExpression,
    EmbeddedMemberSelectionExpression,
    YieldExpression,
    PrefixUnaryExpression,
    PostfixUnaryExpression,
    BinaryExpression,
    IsExpression,
    AsExpression,
    NullableAsExpression,
    ConditionalExpression,
    EvalExpression,
    DefineExpression,
    IssetExpression,
    FunctionCallExpression,
    FunctionPointerExpression,
    ParenthesizedExpression,
    BracedExpression,
    EmbeddedBracedExpression,
    ListExpression,
    CollectionLiteralExpression,
    ObjectCreationExpression,
    ConstructorCall,
    RecordCreationExpression,
    DarrayIntrinsicExpression,
    DictionaryIntrinsicExpression,
    KeysetIntrinsicExpression,
    VarrayIntrinsicExpression,
    VectorIntrinsicExpression,
    ElementInitializer,
    SubscriptExpression,
    EmbeddedSubscriptExpression,
    AwaitableCreationExpression,
    XHPChildrenDeclaration,
    XHPChildrenParenthesizedList,
    XHPCategoryDeclaration,
    XHPEnumType,
    XHPLateinit,
    XHPRequired,
    XHPClassAttributeDeclaration,
    XHPClassAttribute,
    XHPSimpleClassAttribute,
    XHPSimpleAttribute,
    XHPSpreadAttribute,
    XHPOpen,
    XHPExpression,
    XHPClose,
    TypeConstant,
    PUAccess,
    VectorTypeSpecifier,
    KeysetTypeSpecifier,
    TupleTypeExplicitSpecifier,
    VarrayTypeSpecifier,
    VectorArrayTypeSpecifier,
    TypeParameter,
    TypeConstraint,
    DarrayTypeSpecifier,
    MapArrayTypeSpecifier,
    DictionaryTypeSpecifier,
    ClosureTypeSpecifier,
    ClosureParameterTypeSpecifier,
    ClassnameTypeSpecifier,
    FieldSpecifier,
    FieldInitializer,
    ShapeTypeSpecifier,
    ShapeExpression,
    TupleExpression,
    GenericTypeSpecifier,
    NullableTypeSpecifier,
    LikeTypeSpecifier,
    SoftTypeSpecifier,
    AttributizedSpecifier,
    ReifiedTypeArgument,
    TypeArguments,
    TypeParameters,
    TupleTypeSpecifier,
    UnionTypeSpecifier,
    IntersectionTypeSpecifier,
    ErrorSyntax,
    ListItem,
    PocketAtomExpression,
    PocketIdentifierExpression,
    PocketAtomMappingDeclaration,
    PocketEnumDeclaration,
    PocketFieldTypeExprDeclaration,
    PocketFieldTypeDeclaration,
    PocketMappingIdDeclaration,
    PocketMappingTypeDeclaration,

}

impl SyntaxKind {
    pub fn to_string(&self) -> &str {
        match self {
            SyntaxKind::SyntaxList => "list",
            SyntaxKind::Missing => "missing",
            SyntaxKind::Token(_) => "token",
            SyntaxKind::EndOfFile                         => "end_of_file",
            SyntaxKind::Script                            => "script",
            SyntaxKind::QualifiedName                     => "qualified_name",
            SyntaxKind::SimpleTypeSpecifier               => "simple_type_specifier",
            SyntaxKind::LiteralExpression                 => "literal",
            SyntaxKind::PrefixedStringExpression          => "prefixed_string",
            SyntaxKind::VariableExpression                => "variable",
            SyntaxKind::PipeVariableExpression            => "pipe_variable",
            SyntaxKind::FileAttributeSpecification        => "file_attribute_specification",
            SyntaxKind::EnumDeclaration                   => "enum_declaration",
            SyntaxKind::Enumerator                        => "enumerator",
            SyntaxKind::RecordDeclaration                 => "record_declaration",
            SyntaxKind::RecordField                       => "record_field",
            SyntaxKind::AliasDeclaration                  => "alias_declaration",
            SyntaxKind::PropertyDeclaration               => "property_declaration",
            SyntaxKind::PropertyDeclarator                => "property_declarator",
            SyntaxKind::NamespaceDeclaration              => "namespace_declaration",
            SyntaxKind::NamespaceDeclarationHeader        => "namespace_declaration_header",
            SyntaxKind::NamespaceBody                     => "namespace_body",
            SyntaxKind::NamespaceEmptyBody                => "namespace_empty_body",
            SyntaxKind::NamespaceUseDeclaration           => "namespace_use_declaration",
            SyntaxKind::NamespaceGroupUseDeclaration      => "namespace_group_use_declaration",
            SyntaxKind::NamespaceUseClause                => "namespace_use_clause",
            SyntaxKind::FunctionDeclaration               => "function_declaration",
            SyntaxKind::FunctionDeclarationHeader         => "function_declaration_header",
            SyntaxKind::WhereClause                       => "where_clause",
            SyntaxKind::WhereConstraint                   => "where_constraint",
            SyntaxKind::MethodishDeclaration              => "methodish_declaration",
            SyntaxKind::MethodishTraitResolution          => "methodish_trait_resolution",
            SyntaxKind::ClassishDeclaration               => "classish_declaration",
            SyntaxKind::ClassishBody                      => "classish_body",
            SyntaxKind::TraitUsePrecedenceItem            => "trait_use_precedence_item",
            SyntaxKind::TraitUseAliasItem                 => "trait_use_alias_item",
            SyntaxKind::TraitUseConflictResolution        => "trait_use_conflict_resolution",
            SyntaxKind::TraitUse                          => "trait_use",
            SyntaxKind::RequireClause                     => "require_clause",
            SyntaxKind::ConstDeclaration                  => "const_declaration",
            SyntaxKind::ConstantDeclarator                => "constant_declarator",
            SyntaxKind::TypeConstDeclaration              => "type_const_declaration",
            SyntaxKind::DecoratedExpression               => "decorated_expression",
            SyntaxKind::ParameterDeclaration              => "parameter_declaration",
            SyntaxKind::VariadicParameter                 => "variadic_parameter",
            SyntaxKind::OldAttributeSpecification         => "old_attribute_specification",
            SyntaxKind::AttributeSpecification            => "attribute_specification",
            SyntaxKind::Attribute                         => "attribute",
            SyntaxKind::InclusionExpression               => "inclusion_expression",
            SyntaxKind::InclusionDirective                => "inclusion_directive",
            SyntaxKind::CompoundStatement                 => "compound_statement",
            SyntaxKind::ExpressionStatement               => "expression_statement",
            SyntaxKind::MarkupSection                     => "markup_section",
            SyntaxKind::MarkupSuffix                      => "markup_suffix",
            SyntaxKind::UnsetStatement                    => "unset_statement",
            SyntaxKind::UsingStatementBlockScoped         => "using_statement_block_scoped",
            SyntaxKind::UsingStatementFunctionScoped      => "using_statement_function_scoped",
            SyntaxKind::WhileStatement                    => "while_statement",
            SyntaxKind::IfStatement                       => "if_statement",
            SyntaxKind::ElseifClause                      => "elseif_clause",
            SyntaxKind::ElseClause                        => "else_clause",
            SyntaxKind::TryStatement                      => "try_statement",
            SyntaxKind::CatchClause                       => "catch_clause",
            SyntaxKind::FinallyClause                     => "finally_clause",
            SyntaxKind::DoStatement                       => "do_statement",
            SyntaxKind::ForStatement                      => "for_statement",
            SyntaxKind::ForeachStatement                  => "foreach_statement",
            SyntaxKind::SwitchStatement                   => "switch_statement",
            SyntaxKind::SwitchSection                     => "switch_section",
            SyntaxKind::SwitchFallthrough                 => "switch_fallthrough",
            SyntaxKind::CaseLabel                         => "case_label",
            SyntaxKind::DefaultLabel                      => "default_label",
            SyntaxKind::ReturnStatement                   => "return_statement",
            SyntaxKind::GotoLabel                         => "goto_label",
            SyntaxKind::GotoStatement                     => "goto_statement",
            SyntaxKind::ThrowStatement                    => "throw_statement",
            SyntaxKind::BreakStatement                    => "break_statement",
            SyntaxKind::ContinueStatement                 => "continue_statement",
            SyntaxKind::EchoStatement                     => "echo_statement",
            SyntaxKind::ConcurrentStatement               => "concurrent_statement",
            SyntaxKind::SimpleInitializer                 => "simple_initializer",
            SyntaxKind::AnonymousClass                    => "anonymous_class",
            SyntaxKind::AnonymousFunction                 => "anonymous_function",
            SyntaxKind::AnonymousFunctionUseClause        => "anonymous_function_use_clause",
            SyntaxKind::LambdaExpression                  => "lambda_expression",
            SyntaxKind::LambdaSignature                   => "lambda_signature",
            SyntaxKind::CastExpression                    => "cast_expression",
            SyntaxKind::ScopeResolutionExpression         => "scope_resolution_expression",
            SyntaxKind::MemberSelectionExpression         => "member_selection_expression",
            SyntaxKind::SafeMemberSelectionExpression     => "safe_member_selection_expression",
            SyntaxKind::EmbeddedMemberSelectionExpression => "embedded_member_selection_expression",
            SyntaxKind::YieldExpression                   => "yield_expression",
            SyntaxKind::PrefixUnaryExpression             => "prefix_unary_expression",
            SyntaxKind::PostfixUnaryExpression            => "postfix_unary_expression",
            SyntaxKind::BinaryExpression                  => "binary_expression",
            SyntaxKind::IsExpression                      => "is_expression",
            SyntaxKind::AsExpression                      => "as_expression",
            SyntaxKind::NullableAsExpression              => "nullable_as_expression",
            SyntaxKind::ConditionalExpression             => "conditional_expression",
            SyntaxKind::EvalExpression                    => "eval_expression",
            SyntaxKind::DefineExpression                  => "define_expression",
            SyntaxKind::IssetExpression                   => "isset_expression",
            SyntaxKind::FunctionCallExpression            => "function_call_expression",
            SyntaxKind::FunctionPointerExpression         => "function_pointer_expression",
            SyntaxKind::ParenthesizedExpression           => "parenthesized_expression",
            SyntaxKind::BracedExpression                  => "braced_expression",
            SyntaxKind::EmbeddedBracedExpression          => "embedded_braced_expression",
            SyntaxKind::ListExpression                    => "list_expression",
            SyntaxKind::CollectionLiteralExpression       => "collection_literal_expression",
            SyntaxKind::ObjectCreationExpression          => "object_creation_expression",
            SyntaxKind::ConstructorCall                   => "constructor_call",
            SyntaxKind::RecordCreationExpression          => "record_creation_expression",
            SyntaxKind::DarrayIntrinsicExpression         => "darray_intrinsic_expression",
            SyntaxKind::DictionaryIntrinsicExpression     => "dictionary_intrinsic_expression",
            SyntaxKind::KeysetIntrinsicExpression         => "keyset_intrinsic_expression",
            SyntaxKind::VarrayIntrinsicExpression         => "varray_intrinsic_expression",
            SyntaxKind::VectorIntrinsicExpression         => "vector_intrinsic_expression",
            SyntaxKind::ElementInitializer                => "element_initializer",
            SyntaxKind::SubscriptExpression               => "subscript_expression",
            SyntaxKind::EmbeddedSubscriptExpression       => "embedded_subscript_expression",
            SyntaxKind::AwaitableCreationExpression       => "awaitable_creation_expression",
            SyntaxKind::XHPChildrenDeclaration            => "xhp_children_declaration",
            SyntaxKind::XHPChildrenParenthesizedList      => "xhp_children_parenthesized_list",
            SyntaxKind::XHPCategoryDeclaration            => "xhp_category_declaration",
            SyntaxKind::XHPEnumType                       => "xhp_enum_type",
            SyntaxKind::XHPLateinit                       => "xhp_lateinit",
            SyntaxKind::XHPRequired                       => "xhp_required",
            SyntaxKind::XHPClassAttributeDeclaration      => "xhp_class_attribute_declaration",
            SyntaxKind::XHPClassAttribute                 => "xhp_class_attribute",
            SyntaxKind::XHPSimpleClassAttribute           => "xhp_simple_class_attribute",
            SyntaxKind::XHPSimpleAttribute                => "xhp_simple_attribute",
            SyntaxKind::XHPSpreadAttribute                => "xhp_spread_attribute",
            SyntaxKind::XHPOpen                           => "xhp_open",
            SyntaxKind::XHPExpression                     => "xhp_expression",
            SyntaxKind::XHPClose                          => "xhp_close",
            SyntaxKind::TypeConstant                      => "type_constant",
            SyntaxKind::PUAccess                          => "pu_access",
            SyntaxKind::VectorTypeSpecifier               => "vector_type_specifier",
            SyntaxKind::KeysetTypeSpecifier               => "keyset_type_specifier",
            SyntaxKind::TupleTypeExplicitSpecifier        => "tuple_type_explicit_specifier",
            SyntaxKind::VarrayTypeSpecifier               => "varray_type_specifier",
            SyntaxKind::VectorArrayTypeSpecifier          => "vector_array_type_specifier",
            SyntaxKind::TypeParameter                     => "type_parameter",
            SyntaxKind::TypeConstraint                    => "type_constraint",
            SyntaxKind::DarrayTypeSpecifier               => "darray_type_specifier",
            SyntaxKind::MapArrayTypeSpecifier             => "map_array_type_specifier",
            SyntaxKind::DictionaryTypeSpecifier           => "dictionary_type_specifier",
            SyntaxKind::ClosureTypeSpecifier              => "closure_type_specifier",
            SyntaxKind::ClosureParameterTypeSpecifier     => "closure_parameter_type_specifier",
            SyntaxKind::ClassnameTypeSpecifier            => "classname_type_specifier",
            SyntaxKind::FieldSpecifier                    => "field_specifier",
            SyntaxKind::FieldInitializer                  => "field_initializer",
            SyntaxKind::ShapeTypeSpecifier                => "shape_type_specifier",
            SyntaxKind::ShapeExpression                   => "shape_expression",
            SyntaxKind::TupleExpression                   => "tuple_expression",
            SyntaxKind::GenericTypeSpecifier              => "generic_type_specifier",
            SyntaxKind::NullableTypeSpecifier             => "nullable_type_specifier",
            SyntaxKind::LikeTypeSpecifier                 => "like_type_specifier",
            SyntaxKind::SoftTypeSpecifier                 => "soft_type_specifier",
            SyntaxKind::AttributizedSpecifier             => "attributized_specifier",
            SyntaxKind::ReifiedTypeArgument               => "reified_type_argument",
            SyntaxKind::TypeArguments                     => "type_arguments",
            SyntaxKind::TypeParameters                    => "type_parameters",
            SyntaxKind::TupleTypeSpecifier                => "tuple_type_specifier",
            SyntaxKind::UnionTypeSpecifier                => "union_type_specifier",
            SyntaxKind::IntersectionTypeSpecifier         => "intersection_type_specifier",
            SyntaxKind::ErrorSyntax                       => "error",
            SyntaxKind::ListItem                          => "list_item",
            SyntaxKind::PocketAtomExpression              => "pocket_atom",
            SyntaxKind::PocketIdentifierExpression        => "pocket_identifier",
            SyntaxKind::PocketAtomMappingDeclaration      => "pocket_atom_mapping",
            SyntaxKind::PocketEnumDeclaration             => "pocket_enum_declaration",
            SyntaxKind::PocketFieldTypeExprDeclaration    => "pocket_field_type_expr_declaration",
            SyntaxKind::PocketFieldTypeDeclaration        => "pocket_field_type_declaration",
            SyntaxKind::PocketMappingIdDeclaration        => "pocket_mapping_id_declaration",
            SyntaxKind::PocketMappingTypeDeclaration      => "pocket_mapping_type_declaration",
        }
    }

    pub fn ocaml_tag(self) -> u8 {
        match self {
            SyntaxKind::Missing => 0,
            SyntaxKind::Token(_) => 0,
            SyntaxKind::SyntaxList => 1,
            SyntaxKind::EndOfFile => 2,
            SyntaxKind::Script => 3,
            SyntaxKind::QualifiedName => 4,
            SyntaxKind::SimpleTypeSpecifier => 5,
            SyntaxKind::LiteralExpression => 6,
            SyntaxKind::PrefixedStringExpression => 7,
            SyntaxKind::VariableExpression => 8,
            SyntaxKind::PipeVariableExpression => 9,
            SyntaxKind::FileAttributeSpecification => 10,
            SyntaxKind::EnumDeclaration => 11,
            SyntaxKind::Enumerator => 12,
            SyntaxKind::RecordDeclaration => 13,
            SyntaxKind::RecordField => 14,
            SyntaxKind::AliasDeclaration => 15,
            SyntaxKind::PropertyDeclaration => 16,
            SyntaxKind::PropertyDeclarator => 17,
            SyntaxKind::NamespaceDeclaration => 18,
            SyntaxKind::NamespaceDeclarationHeader => 19,
            SyntaxKind::NamespaceBody => 20,
            SyntaxKind::NamespaceEmptyBody => 21,
            SyntaxKind::NamespaceUseDeclaration => 22,
            SyntaxKind::NamespaceGroupUseDeclaration => 23,
            SyntaxKind::NamespaceUseClause => 24,
            SyntaxKind::FunctionDeclaration => 25,
            SyntaxKind::FunctionDeclarationHeader => 26,
            SyntaxKind::WhereClause => 27,
            SyntaxKind::WhereConstraint => 28,
            SyntaxKind::MethodishDeclaration => 29,
            SyntaxKind::MethodishTraitResolution => 30,
            SyntaxKind::ClassishDeclaration => 31,
            SyntaxKind::ClassishBody => 32,
            SyntaxKind::TraitUsePrecedenceItem => 33,
            SyntaxKind::TraitUseAliasItem => 34,
            SyntaxKind::TraitUseConflictResolution => 35,
            SyntaxKind::TraitUse => 36,
            SyntaxKind::RequireClause => 37,
            SyntaxKind::ConstDeclaration => 38,
            SyntaxKind::ConstantDeclarator => 39,
            SyntaxKind::TypeConstDeclaration => 40,
            SyntaxKind::DecoratedExpression => 41,
            SyntaxKind::ParameterDeclaration => 42,
            SyntaxKind::VariadicParameter => 43,
            SyntaxKind::OldAttributeSpecification => 44,
            SyntaxKind::AttributeSpecification => 45,
            SyntaxKind::Attribute => 46,
            SyntaxKind::InclusionExpression => 47,
            SyntaxKind::InclusionDirective => 48,
            SyntaxKind::CompoundStatement => 49,
            SyntaxKind::ExpressionStatement => 50,
            SyntaxKind::MarkupSection => 51,
            SyntaxKind::MarkupSuffix => 52,
            SyntaxKind::UnsetStatement => 53,
            SyntaxKind::UsingStatementBlockScoped => 54,
            SyntaxKind::UsingStatementFunctionScoped => 55,
            SyntaxKind::WhileStatement => 56,
            SyntaxKind::IfStatement => 57,
            SyntaxKind::ElseifClause => 58,
            SyntaxKind::ElseClause => 59,
            SyntaxKind::TryStatement => 60,
            SyntaxKind::CatchClause => 61,
            SyntaxKind::FinallyClause => 62,
            SyntaxKind::DoStatement => 63,
            SyntaxKind::ForStatement => 64,
            SyntaxKind::ForeachStatement => 65,
            SyntaxKind::SwitchStatement => 66,
            SyntaxKind::SwitchSection => 67,
            SyntaxKind::SwitchFallthrough => 68,
            SyntaxKind::CaseLabel => 69,
            SyntaxKind::DefaultLabel => 70,
            SyntaxKind::ReturnStatement => 71,
            SyntaxKind::GotoLabel => 72,
            SyntaxKind::GotoStatement => 73,
            SyntaxKind::ThrowStatement => 74,
            SyntaxKind::BreakStatement => 75,
            SyntaxKind::ContinueStatement => 76,
            SyntaxKind::EchoStatement => 77,
            SyntaxKind::ConcurrentStatement => 78,
            SyntaxKind::SimpleInitializer => 79,
            SyntaxKind::AnonymousClass => 80,
            SyntaxKind::AnonymousFunction => 81,
            SyntaxKind::AnonymousFunctionUseClause => 82,
            SyntaxKind::LambdaExpression => 83,
            SyntaxKind::LambdaSignature => 84,
            SyntaxKind::CastExpression => 85,
            SyntaxKind::ScopeResolutionExpression => 86,
            SyntaxKind::MemberSelectionExpression => 87,
            SyntaxKind::SafeMemberSelectionExpression => 88,
            SyntaxKind::EmbeddedMemberSelectionExpression => 89,
            SyntaxKind::YieldExpression => 90,
            SyntaxKind::PrefixUnaryExpression => 91,
            SyntaxKind::PostfixUnaryExpression => 92,
            SyntaxKind::BinaryExpression => 93,
            SyntaxKind::IsExpression => 94,
            SyntaxKind::AsExpression => 95,
            SyntaxKind::NullableAsExpression => 96,
            SyntaxKind::ConditionalExpression => 97,
            SyntaxKind::EvalExpression => 98,
            SyntaxKind::DefineExpression => 99,
            SyntaxKind::IssetExpression => 100,
            SyntaxKind::FunctionCallExpression => 101,
            SyntaxKind::FunctionPointerExpression => 102,
            SyntaxKind::ParenthesizedExpression => 103,
            SyntaxKind::BracedExpression => 104,
            SyntaxKind::EmbeddedBracedExpression => 105,
            SyntaxKind::ListExpression => 106,
            SyntaxKind::CollectionLiteralExpression => 107,
            SyntaxKind::ObjectCreationExpression => 108,
            SyntaxKind::ConstructorCall => 109,
            SyntaxKind::RecordCreationExpression => 110,
            SyntaxKind::DarrayIntrinsicExpression => 111,
            SyntaxKind::DictionaryIntrinsicExpression => 112,
            SyntaxKind::KeysetIntrinsicExpression => 113,
            SyntaxKind::VarrayIntrinsicExpression => 114,
            SyntaxKind::VectorIntrinsicExpression => 115,
            SyntaxKind::ElementInitializer => 116,
            SyntaxKind::SubscriptExpression => 117,
            SyntaxKind::EmbeddedSubscriptExpression => 118,
            SyntaxKind::AwaitableCreationExpression => 119,
            SyntaxKind::XHPChildrenDeclaration => 120,
            SyntaxKind::XHPChildrenParenthesizedList => 121,
            SyntaxKind::XHPCategoryDeclaration => 122,
            SyntaxKind::XHPEnumType => 123,
            SyntaxKind::XHPLateinit => 124,
            SyntaxKind::XHPRequired => 125,
            SyntaxKind::XHPClassAttributeDeclaration => 126,
            SyntaxKind::XHPClassAttribute => 127,
            SyntaxKind::XHPSimpleClassAttribute => 128,
            SyntaxKind::XHPSimpleAttribute => 129,
            SyntaxKind::XHPSpreadAttribute => 130,
            SyntaxKind::XHPOpen => 131,
            SyntaxKind::XHPExpression => 132,
            SyntaxKind::XHPClose => 133,
            SyntaxKind::TypeConstant => 134,
            SyntaxKind::PUAccess => 135,
            SyntaxKind::VectorTypeSpecifier => 136,
            SyntaxKind::KeysetTypeSpecifier => 137,
            SyntaxKind::TupleTypeExplicitSpecifier => 138,
            SyntaxKind::VarrayTypeSpecifier => 139,
            SyntaxKind::VectorArrayTypeSpecifier => 140,
            SyntaxKind::TypeParameter => 141,
            SyntaxKind::TypeConstraint => 142,
            SyntaxKind::DarrayTypeSpecifier => 143,
            SyntaxKind::MapArrayTypeSpecifier => 144,
            SyntaxKind::DictionaryTypeSpecifier => 145,
            SyntaxKind::ClosureTypeSpecifier => 146,
            SyntaxKind::ClosureParameterTypeSpecifier => 147,
            SyntaxKind::ClassnameTypeSpecifier => 148,
            SyntaxKind::FieldSpecifier => 149,
            SyntaxKind::FieldInitializer => 150,
            SyntaxKind::ShapeTypeSpecifier => 151,
            SyntaxKind::ShapeExpression => 152,
            SyntaxKind::TupleExpression => 153,
            SyntaxKind::GenericTypeSpecifier => 154,
            SyntaxKind::NullableTypeSpecifier => 155,
            SyntaxKind::LikeTypeSpecifier => 156,
            SyntaxKind::SoftTypeSpecifier => 157,
            SyntaxKind::AttributizedSpecifier => 158,
            SyntaxKind::ReifiedTypeArgument => 159,
            SyntaxKind::TypeArguments => 160,
            SyntaxKind::TypeParameters => 161,
            SyntaxKind::TupleTypeSpecifier => 162,
            SyntaxKind::UnionTypeSpecifier => 163,
            SyntaxKind::IntersectionTypeSpecifier => 164,
            SyntaxKind::ErrorSyntax => 165,
            SyntaxKind::ListItem => 166,
            SyntaxKind::PocketAtomExpression => 167,
            SyntaxKind::PocketIdentifierExpression => 168,
            SyntaxKind::PocketAtomMappingDeclaration => 169,
            SyntaxKind::PocketEnumDeclaration => 170,
            SyntaxKind::PocketFieldTypeExprDeclaration => 171,
            SyntaxKind::PocketFieldTypeDeclaration => 172,
            SyntaxKind::PocketMappingIdDeclaration => 173,
            SyntaxKind::PocketMappingTypeDeclaration => 174,
        }
    }
}
