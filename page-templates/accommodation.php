<?php
/**
 * ============== Template Name: Accommodation
 *
 * @package oke
 */
get_header();?>

<!-- ******************* Map Component ******************* -->
<?php get_template_part("template-parts/map-component"); ?>

<div class="outer-wrapper">
<div class="container grid-gap cols-16-8 pt3">
	<div class="col">
		<div class="leading-copy">
			<?php the_field('leading_copy_paragraph');?>
		</div>
		<div class="two-columns mb3">
			<?php the_field('page_copy');?>
		</div>
		<?php $ctaImage = get_field('background_image');?>
			<div class="cta cta--focus" style="background-image: url(<?php echo $ctaImage['url']; ?>);">
				<div class="content">
					<h3 class="heading heading__lg heading__light">
						<?php the_field('heading');?>
					</h3>
					<p><?php the_field('content');?></p>
					<a href="<?php the_field('button_target');?>"><?php the_field('button_text');?></a>
				</div>
			</div><!--cta focus-->
	</div>
	<div class="col">
		<h4 class="heading heading__md heading__caps heading__body mb1">Our Travel Partners</h4>
		<div class="company-summary toggle-wrapper">
			<?php
			$terms = get_terms( array(
			    'taxonomy' => 'company'
			) );
			$number = 1;
			foreach ($terms as $term):
			$companyImage = get_field('banner_image', $term);
			?>
			<div class="company-summary__item">
					<input class="toggle" id="id-<?php echo $number;?>" type="checkbox"/>
					<div class="header">
  					<label class="group" for="id-<?php echo $number;?>">
						<h2 class="heading heading__sm heading__caps heading__body"><?php echo $term->name;?></h2>
						<?php get_template_part("template-parts/arrow-large"); ?>
					</label>
				</div>
				<div class="body hideable">
					<div class="image" style="background:url(<?php echo $companyImage['url']; ?>);"></div>
					<?php the_field('short_description', $term);?>
					<a href="<?php echo $term_link = get_term_link( $term ); ?>" class="button"><span>View All</span>ACCOMMODATION</a>
				</div>
			</div>
			<?php
			$number++;
			endforeach;?>
		</div><!--company-sidebar-->
	</div>
</div>
</div><!--outer wrapper-->
<?php get_footer();?>
