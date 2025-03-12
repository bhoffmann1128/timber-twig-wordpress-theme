<?php
/**
 * Single product short description
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/short-description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $post;

$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );

if ( ! $short_description ) {
	return;
}

?>
<div class="woocommerce-product-details__short-description">

    <?php $tagline = get_field('product_tagline'); ?>
    <?php if($tagline): ?>
        <h4><em><?php echo $tagline; ?></em></h4>
    <?php endif; ?>

    <?php $productAuthors = get_field('product_author', $post->ID); ?>
    <?php if($productAuthors): ?>
        <div class="single_product_authors_container">
            <span>By</span>
            <?php 
                $firstKey = array_key_first($productAuthors);
                $lastKey = array_key_last($productAuthors);
                foreach($productAuthors as $key => $author):
                    $titles = get_field('author_titles', $author->ID);
                    $titles = $titles ? ", " . $titles : "";
            ?>
                <a href="<?php echo get_the_permalink($author->ID); ?>">
                    <?php echo $author->post_title; ?>
                    <?php echo $titles; ?>
                </a>
                <?php if($key != $lastKey - 1): ?>
                    <span>,</span>
                <?php else: ?>
                    <span>and</span>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <?php echo $short_description; // WPCS: XSS ok. ?>

    <?php if(get_field('request_exam_copy')): ?>
        <a href="/request-exam-copy-2/" class="btn btn-requestexam btn-primary">Request Exam Copy</a>
    <?php endif; ?>
	
</div>
