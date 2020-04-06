<?php $term = get_queried_object();?>
<div class="floating-heading">
    <div class="container grid-gap cols-8-13">
        <div class="col">
        </div>
        <div class="col pl2">
            <h1 class="heading heading__lg heading__light heading__caps">            <?php if ( is_tax('company', $term) ) {
                            echo $term->name;
                        } else {
                            the_title();
                        } ?>
            </h1>
            <h2 class="heading heading__md heading__light heading__alt">
                <?php if ( is_front_page() && is_home() ) {
                  // Default homepage - empty
                } elseif ( is_singular( 'camps' ) ) {
                  the_terms( $post->ID, 'destinations');
                  } elseif ( is_singular( 'itineraries' ) ) {
                  the_field('sub_headline');
                } elseif ( is_tax('company') ) {
                  the_field('sub_headline', $term);
              } elseif ( is_page('enquire') ) {
                echo the_field('hero_copy');
                } else {
                  echo 'all else';
                }
                ?>
            </h2>
        </div>
    </div>
</div>
