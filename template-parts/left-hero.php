<?php
$term = get_queried_object();
if ( is_tax('company')) {
 $heroImage = get_field('banner_image');
} elseif ( is_tax('destinations')) {
     $heroImage = get_field('banner_image', $term);
} else {
	$heroImage = get_field('hero_background_image');
}
?>

<div class="hero left-hero lower-grad" style="background-image: url(<?php echo $heroImage['url']; ?>);">
    <div class="container cols-16-8 ">
		<div class="col pb5">
                <h1 class="heading heading__lg heading__caps heading__light slow-fade mb0">
                    <?php if ( is_tax('company') ) {
                        echo $term->name;
                    } elseif ( is_tax('destinations')){
                        echo $term->name;
                    } elseif ( is_page('enquire')){
                        //empty - this is rendered next to the sidebar
                    } else {
                        the_title();
                    }?>

                </h1>
				<p class="heading__light heading__sm">
                    <?php if ( is_tax('company') ) {
                        echo the_field('sub_headline', $term);
                        } elseif ( is_tax('destinations')){
                        echo the_field('sub_heading', $term);
                        } elseif ( is_page('enquire')){
                            //empty - this is rendered next to the sidebar
                        } else {
                            echo the_field('hero_copy');
                        }?>
				</p>
		</div>
        <div class="col"></div>
	</div>
</div>
