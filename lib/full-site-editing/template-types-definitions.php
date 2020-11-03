<?php
/**
 * Template types definitions.
 *
 * @package gutenberg
 */

function gutenberg_get_default_template_types_definitions() {
	$template_type_definitions = array(
		'index'          => array(
			'title'         => _x( 'Default (Index)', 'Template name', 'gutenberg' ),
			'description'   => __( 'Main template, applied when no other template is found', 'gutenberg' ),
		),
		'home'           => array(
			'title'         => _x( 'Home', 'Template name', 'gutenberg' ),
			'description'   => __( 'Template for the latest blog posts', 'gutenberg' ),
		),
		'front-page'     => array(
			'title'         => _x( 'Front Page', 'Template name', 'gutenberg' ),
			'description'   => __( 'Front page template, whether it displays the blog posts index or a static page', 'gutenberg' ),
		),
		'singular'       => array(
			'title'         => _x( 'Default Singular', 'Template name', 'gutenberg' ),
			'description'   => __( 'Displays any content on a single page', 'gutenberg' ),
		),
		'single'         => array(
			'title'         => _x( 'Default Single', 'Template name', 'gutenberg' ),
			'description'   => __( 'Applied to individual content like a blog post', 'gutenberg' ),
		),
		'page'           => array(
			'title'         => _x( 'Default Page', 'Template name', 'gutenberg' ),
			'description'   => __( 'Applied to individual pages', 'gutenberg' ),
		),
		'archive'        => array(
			'title'         => _x( 'Default Archive', 'Template name', 'gutenberg' ),
			'description'   => __( 'Applied to archives like your posts page, categories, or tags', 'gutenberg' ),
		),
		'author'         => array(
			'title'         => _x( 'Default Author Archive', 'Template name', 'gutenberg' ),
			'description'   => __( 'Displays a list of posts by a single author', 'gutenberg' ),
		),
		'category'       => array(
			'title'         => _x( 'Default Post Category Archive', 'Template name', 'gutenberg' ),
			'description'   => __( 'Displays a list of posts in a category', 'gutenberg' ),
		),
		'taxonomy'       => array(
			'title'         => _x( 'Default Taxonomy Archive', 'Template name', 'gutenberg' ),
			'description'   => __( 'Displays a list of posts in a taxonomy', 'gutenberg' ),
		),
		'date'           => array(
			'title'         => _x( 'Default Date Archive', 'Template name', 'gutenberg' ),
			'description'   => __( 'Displays a list of posts in a date range', 'gutenberg' ),
		),
		'tag'            => array(
			'title'         => _x( 'Default Tag Archive', 'Template name', 'gutenberg' ),
			'description'   => __( 'Displays a list of posts with a tag', 'gutenberg' ),
		),
		'attachment'     => array(
			'title'         => __( 'Media', 'gutenberg' ),
			'description'   => __( 'Displays media content', 'gutenberg' ),
		),
		'search'         => array(
			'title'         => __( 'Search Results', 'gutenberg' ),
			'description'   => __( 'Applied to search results', 'gutenberg' ),
		),
		'privacy-policy' => array(
			'title'         => __( 'Privacy Policy', 'gutenberg' ),
			'description'   => '',
		),
		'404'            => array(
			'title'         => _x( '404 (Not Found)', 'Template name', 'gutenberg' ),
			'description'   => __( 'Applied when content cannot be found', 'gutenberg' ),
		),
		'embed'          => array(
			'title'         => __( 'Embed', 'gutenberg' ),
			'description'   => __( '[Currently unsupported]', 'gutenberg' ),
		),
	);

	/**
	 * Filters the list of template types definitions.
	 *
	 * @param array $template_type_definitions An array of template types definitions, formatted as [ slug => [ title, description ] ].
	 *
	 * @since 5.x.x
	 */
	return apply_filters( 'template_types_definitions', $template_type_definitions );
}

/**
 * Converts the default template types definitions array from associative to indexed,
 * to be used in JS, where numeric keys (e.g. '404') always appear before alphabetical
 * ones, regardless of the actual order of the array.
 *
 * From slug-keyed associative array:
 * `[ 'index' => [ 'title' => 'Index', 'description' => 'Index template' ] ]`
 *
 * ...to indexed array with slug as property:
 * `[ [ 'slug' => 'index', 'title' => 'Index', 'description' => 'Index template' ] ]`
 *
 * @return array The default template types definitions as an indexed array.
 */
function gutenberg_get_indexed_default_template_types_definitions() {
	$definitions         = array();
	$default_definitions = gutenberg_get_default_template_types_definitions();
	foreach( $default_definitions as $slug => $definition ) {
		$definition['slug'] = $slug;
		$definitions[]      = $definition;
	}
	return $definitions;
}
