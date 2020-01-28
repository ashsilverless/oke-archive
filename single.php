<?php
/**
 * The template for displaying all single posts
 *
 * @package oke
 */
get_header();
if (have_posts()) : while (have_posts()) : the_post();
$heroImage = get_field('banner_image'); ?>

<!-- ******************* Hero Content ******************* -->

<div class="hero standard h75 mb2" style="background-image: url(<?php echo $heroImage; ?>);">
    <div class="container align-center">
		<div class="col">
		    <div class="hero__content">
                <h1 class="heading heading__lg heading__caps heading__light"><?php the_title();  ?></h1>
		    </div>
		</div>
	</div>
</div><!--hero standard-->

<!-- ******************* Hero Content END ******************* -->

<div class="container cols-15-9 border-split">
	<div class="col mb3">
		<div class="description camp mb3">
			<?php the_content(); ?>
		</div>
		<div class="post-links">
			<div>
				<?php $next_post = get_adjacent_post(false, '', true);
				if(!empty($next_post)) {
				echo '<a href="' . get_permalink($next_post->ID) . '" title="' . $next_post->post_title . '"> <i class="fas fa-angle-left"></i>' . $next_post->post_title . '</a>'; }?>
			</div>
			<div>
				<?php $next_post = get_adjacent_post(false, '', false);
				if(!empty($next_post)) {
				echo '<a href="' . get_permalink($next_post->ID) . '" title="' . $next_post->post_title . '"> ' . $next_post->post_title . '<i class="fas fa-angle-right"></i></a>'; }?>
			</div>
		</div>
	</div>
	<div class="col">
		<h2 class="heading heading__md mb1">Latest News</h2>

        <div class="wrapper-news">
            <?php
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        $query = new WP_Query( array(
            'posts_per_page' => 3,
            'paged' => $paged,
            'category_name' => 'news'
        ) );
        if ( $query->have_posts() ): while ( $query->have_posts() ) : $query->the_post(); ?>
            <?php $image = get_field('banner_image');?>
            <div class="item image-top">
                <div class="image" style="background: url(<?php echo $image; ?>)"><a href="<?php the_permalink(); ?>"></a></div>
                <div class="content">
                    <a href="<?php the_permalink(); ?>">
                        <h3 class="heading heading__md"><?php the_title(); ?></h3>
                    </a>
                    <p class="date"><?php echo get_the_date("jS F Y"); ?></p>
                    <p><?php echo substr(wp_strip_all_tags(get_the_content()), 0, 80) . ""; ?> ...</p>
                    <a class="button button__standard" href="<?php the_permalink(); ?>">Read More</a>
                </div>
            </div>
            <!--item-->
            <?php endwhile;?>
            <div class="pagination">
                <?php echo paginate_links( array(
                    'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                    'total'        => $query->max_num_pages,
                    'current'      => max( 1, get_query_var( 'paged' ) ),
                    'format'       => '?paged=%#%',
                    'show_all'     => false,
                    'type'         => 'plain',
                    'end_size'     => 1,
                    'mid_size'     => 1,
                    'prev_next'    => true,
                    'prev_text'    => sprintf( '<i class="fas fa-angle-left"></i>' ),
                    'next_text'    => sprintf( '<i class="fas fa-angle-right"></i>' ),
                    'add_args'     => false,
                    'add_fragment' => '',
                ) );

                        ?></div>
            <? wp_reset_postdata(); endif; ?>
        </div>
        <!--wrapper-news-->
</div><!--col-->
</div>
<?php endwhile; endif; ?>
<?php get_footer(); ?>
