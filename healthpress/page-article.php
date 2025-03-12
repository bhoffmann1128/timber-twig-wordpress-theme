<?php
/**
 * Article Template for HealthPress - Best Friends Child Theme
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::context();
$timber_post     = Timber::get_post();

$context['post'] = $timber_post;

$pageID = $_GET['pageid'];


$blogpost = wp_remote_get("https://blog.healthpropress.com/wp-json/blogposts/get_single/?pageid=".$pageID, array(
    'headers' => array(
        'Content-Type' => 'application/json'
    )
));
$bp = json_decode(wp_remote_retrieve_body( $blogpost));
$context['article'] = $bp[0];

Timber::render( array( 'article.twig' ), $context );