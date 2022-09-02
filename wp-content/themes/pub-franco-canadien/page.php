<?php get_header();

if (have_posts()) {
    the_post();


?>

    <div class="d-flex-commentaire">
        <h2><?php the_title(); ?></h2>
        <p><?php the_content(); ?></p>
    </div>
<?php
} else {
    echo "Pas d'article :'(";
}


get_footer();
