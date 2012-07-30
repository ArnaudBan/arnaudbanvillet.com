<?php

/*
 * Add a custom post type : Portfolio
 * @package WordPress
 * @subpackage ArnaudBanvillet.com
 */

function ab_portfolio_custom_init() {
	$labels = array(
		'name' => __('Portfolio'),
		'singular_name' => __('Portfolio'),
		'add_new' => __('Add New'),
		'add_new_item' => __('Add New Portfolio'),
		'edit_item' => __('Edit Portfolio'),
		'new_item' => __('New Portfolio'),
		'all_items' => __('All Portfolio'),
		'view_item' => __('View Portfolio'),
		'search_items' => __('Search Portfolio'),
		'not_found' =>  __('No Portfolio found'),
		'not_found_in_trash' => __('No Portfolio found in Trash'),
		'parent_item_colon' => '',
		'menu_name' => __('Portfolio')

	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => true,
		'menu_position' => null,
		'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt')
	);
	register_post_type('portfolio',$args);
}
add_action( 'init', 'ab_portfolio_custom_init' );