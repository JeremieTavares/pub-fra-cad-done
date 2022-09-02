<?php
/*
Plugin Name: Gestion des promotions
Description: Pluggin for TP Final
Author: Equipe C
Version: 1.0
*/

// ====================================================================================================================
function registerCPTevenementPromotion()
{
    $labels = array(                            
        'name' => 'Gestion promotion',
        'all_items' => 'Toutes les promotions',
        'singular_name' => 'promotion',
        'add_new_item' => 'Ajouter une promotion',
        'edit_item' => 'Modifier une promotion',
        'menu_name' => 'Gestion promotion'
    );

    $args = array(                               // Les auguments/specifications pour notre CPT

        'labels' => $labels,                          // Voir tableau ci-dessus
        'public' => true,                             // Permet l’affichage de ce type de contenu (pas juste backend)
        'show_in_rest' => true,                       // Ajoute le CPT à l’API et permet l’utilisation de Gutengerg
        'has_archive' => true,                          // true = type article
        'publicly_queryable' => true,
        'supports' => array('title', 'editor', 'thumbnail'),                // Ce que le CPT inclus
        'menu_position' => 999,                                    // Emplacement dans le menu WP
        'menu_icon' => 'dashicons-clipboard'
    );

    register_post_type('promotion', $args); // Ceci enregistre le nouveau CPT

    flush_rewrite_rules(); // Ceci est pour vider la cache et afficher le nouveau CPT dans le side menu
}
add_action('init', 'registerCPTevenementPromotion');
// ====================================================================================================================



// ====================================================================================================================
add_filter('single_template', 'sinle_custom_template_promotion');

function sinle_custom_template_promotion($single)
{
    global $post;
    if ($post->post_type == 'promotion' && locate_template(array('single-promotion.php')) !== $single) {
        if (file_exists(plugin_dir_path(__FILE__) . 'template/single-promotion.php')) {
            return plugin_dir_path(__FILE__) . 'template/single-promotion.php';
        }
    }
    return $single;
}
// ====================================================================================================================
