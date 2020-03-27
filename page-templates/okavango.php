<?php
/**
 * ============== Template Name: Okavango
 *
 * @package oke
 */
get_header();?>

<!-- ******************* Hero ******************* -->
<?php if( have_rows('hero') ): while( have_rows('hero') ): the_row();
 $heroImage = get_sub_field('background_image');?>
<div class="hero hero__section-lead h75" style="background-image: url(<?php echo $heroImage['url']; ?>);">
    <div class="above-leader container cols-offset-3-16">
        <div class="col">
            <h3 class="heading heading__lg heading__caps heading__light">
                <?php the_sub_field('heading');?>
            </h3>
            <h2 class="heading heading__sm heading__light heading__alt">
                <?php the_sub_field('sub_heading');?>
            </h2>
        </div>
    </div>
</div>
<?php endwhile; endif;?>


<?php if( have_rows('call_to_action') ):
while( have_rows('call_to_action') ): the_row();
$ctaImage = get_sub_field('background_image');?>
<div class="cta cta__dark-text">
    <div class="container cols-offset3-12 pt5 pb5">
        <div class="col">
            <div class="content">
                <h3 class="heading heading__md heading__caps"><?php the_sub_field('heading');?></h3>
                <p><?php the_sub_field('content');?></p>
                <a href="<?php the_sub_field('button_target');?>" class="button button__dark-ghost"><?php the_sub_field('button_text');?></a>
            </div>
        </div>
    </div>
</div><!--cta fullwidth-->
<?php endwhile; endif;?>

<div class="container grid-gap cols-offset-3-6">
    <?php if( have_rows('image_panels') ):
while( have_rows('image_panels') ): the_row();
$panelImage = get_sub_field('image');?>
        <div class="col leader mb5">
            <div class="leader__image" style="background-image: url(<?php echo $panelImage['url']; ?>);"></div>
            <div class="content pb1 pt1 pl2 pr2">
                <h3 class="heading heading__md inline-icon leader__heading">
                    <sup>The</sup>
                    <span class="heading__caps"><?php the_sub_field('heading');?></span>
                </h3>
                <p><?php the_sub_field('copy');?></p>
                <a href="<?php the_sub_field('target_link');?>" class="button button__standard">Read More</a>
            </div>
        </div>
    <?php endwhile; endif;?>
</div>

<?php get_template_part('template-parts/fullwidth-info-block');?>

<?php if( have_rows('lower_call_to_action') ):
while( have_rows('lower_call_to_action') ): the_row();
$ctaImage = get_sub_field('background_image');?>
<div class="cta cta--fullwidth <?php the_sub_field('background_align');?>" style="background-image: url(<?php echo $ctaImage['url']; ?>);">
    <div class="container align-center pt5 pb3">
        <div class="col">
            <div class="content lg-narrow">
                <h3 class="heading heading__md heading__caps heading__light"><?php the_sub_field('heading');?></h3>
                <p><?php the_sub_field('content');?></p>
                <a href="<?php the_sub_field('button_target');?>" class="button button__ghost"><?php the_sub_field('button_text');?></a>
            </div>
        </div>
    </div>
</div><!--cta fullwidth-->
<?php endwhile; endif;?>


<?php get_footer();?>
