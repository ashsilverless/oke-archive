<?php if ( is_page_template( 'page-templates/accommodation.php' ) ) {?>
<div class="popup-image wrapper">
    <div class="open trigger"><i class="fas fa-map-marked-alt"></i></div>
    <div class="profile-image reveal">
        <?php get_template_part('inc/img/small-map');?>
        <div class="close-trigger"><i class="far fa-times-circle"></i></div>
    </div>
</div>
<?php } else {}?>

<div class="overlay-filter">
    <img src="/wp-content/themes/oke/inc/img/droplet.svg" />
    <p class="heading heading__light heading__body heading__caps">Water State</p>
    <div class="layer-buttons">
        <div class="layer-buttons__item off active">Off</div>
        <div class="layer-buttons__item low">Low</div>
        <div class="layer-buttons__item high">High</div>
    </div>
    <a href="/the-okavango/land/" class="button button__ghost mt1 info-link">
<i class="fas fa-info"></i>
        Learn About the Okavango Flood
    </a>
</div>
