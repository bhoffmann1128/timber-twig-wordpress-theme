<?php

	/* Template Name: Announcements */

$context         = Timber::context();
$timber_post     = Timber::get_post();
$context['post'] = Timber::get_post();

$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$args = array(
	'post_type'		=> 'post',
	'orderby'        => 'date',
		'order'			=> 'DESC',
		'paged' => $paged,
);

$announcements = Timber::get_posts($args);
$context['announcements'] = $announcements;
$context['show_sidebar'] = get_field('page__show_sidebar');
$context['show_page_title'] = get_field('show_page_title');

if ( post_password_required( $timber_post->ID ) ) {
	Timber::render( 'single-password.twig', $context );
} else {
	Timber::render( array( 'blog.twig' ), $context );
}

?>