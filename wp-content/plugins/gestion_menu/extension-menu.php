<?php
/*
Plugin Name: Gestion des menu
Description: Pluggin for TP Final
Author: Equipe C
Version: 1.0
*/

// ====================================================================================================================
function registerCPTevenement()
{
    $labels = array(                            
        'name' => 'Gestion Menu',
        'all_items' => 'Toutes les menu',
        'singular_name' => 'menu',
        'add_new_item' => 'Ajouter un menu',
        'edit_item' => 'Modifier un menu',
        'menu_name' => 'Gestion Menu'
    );

    $args = array(                               // Les auguments/specifications pour notre CPT

        'labels' => $labels,                          // Voir tableau ci-dessus
        'public' => true,                             // Permet l’affichage de ce type de contenu (pas juste backend)
        'show_in_rest' => true,                       // Ajoute le CPT à l’API et permet l’utilisation de Gutengerg
        'has_archive' => true,                          // true = type article
        'publicly_queryable' => true,
        'supports' => array('title', 'thumbnail'),                // Ce que le CPT inclus
        'menu_position' => 999,                                    // Emplacement dans le menu WP
        'menu_icon' => 'dashicons-clipboard'
    );

    register_post_type('menu', $args); // Ceci enregistre le nouveau CPT

    flush_rewrite_rules(); // Ceci est pour vider la cache et afficher le nouveau CPT dans le side menu
}
add_action('init', 'registerCPTevenement');
// ====================================================================================================================





// ====================================================================================================================
// Permet de generer le contenu/afficher des pages archive-php / 2ime manieres de faire
add_filter('archive_template', 'get_custom_post_type_template');
function get_custom_post_type_template($archive_template)
{
    global $post;
    $plugin_root_dir = WP_PLUGIN_DIR . '/gestion_menu/';

    if (is_archive() && get_post_type($post) == 'menu') {
        $archive_template = $plugin_root_dir . '/template/archive-menu.php';
    }
    return $archive_template;
}
// ====================================================================================================================
