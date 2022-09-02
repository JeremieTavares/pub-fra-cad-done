<?php get_header(); ?>
<h1 class="h1Menu">Notre promotion en cours !</h1>
<div class="wrapper">


    <?php
    $args = array(
        'post_type' => 'promotion', // Quel type de post on veut afficher
    );


    query_posts($args);
    if (have_posts()) {
        while (have_posts()) {
            the_post();

    ?>
            <div class="div_menu">
                <h2><?php the_title(); ?></h2>
                <p><strong>Description: </strong><?php the_field(''); ?></p>
                <p><strong>Prix: </strong><?php the_field(''); ?>$</p>
                <img class='imgPlat' src="<?php the_field('') ?>" />
            </div>
    <?php
        }
    } else {
        echo "Pas d'article :'(";
    } ?>
</div>


<?php get_footer(); ?>


