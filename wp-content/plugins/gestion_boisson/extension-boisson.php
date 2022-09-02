<?php
/*
Plugin Name: Gestion des boisson
Description: Pluggin for TP Final
Author: Equipe C
Version: 1.0
*/

// ====================================================================================================================
function registerCPTevenementBoisson()
{
    $labels = array(                            
        'name' => 'Gestion boisson',
        'all_items' => 'Toutes les boisson',
        'singular_name' => 'boisson',
        'add_new_item' => 'Ajouter un boisson',
        'edit_item' => 'Modifier un boisson',
        'menu_name' => 'Gestion boisson'
    );

    $args = array(                               // Les auguments/specifications pour notre CPT

        'labels' => $labels,                          // Voir tableau ci-dessus
        'public' => true,                             // Permet l’affichage de ce type de contenu (pas juste backend)
        'show_in_rest' => true,                       // Ajoute le CPT à l’API et permet l’utilisation de Gutengerg
        'has_archive' => true,                          // true = type article
        'publicly_queryable' => true,
        'supports' => array('title', 'thumbnail'),                // Ce que le CPT inclus
        'menu_position' => 998,                                    // Emplacement dans le menu WP
        'menu_icon' => 'dashicons-clipboard'
    );

    register_post_type('boisson', $args); // Ceci enregistre le nouveau CPT

    flush_rewrite_rules(); // Ceci est pour vider la cache et afficher le nouveau CPT dans le side menu
}
add_action('init', 'registerCPTevenementBoisson');
// ====================================================================================================================





// ====================================================================================================================
// Permet de generer le contenu/afficher des pages archive-php / 2ime manieres de faire
add_filter('archive_template', 'get_custom_post_type_template_boisson');
function get_custom_post_type_template_boisson($archive_template)
{
    global $post;
    $plugin_root_dir = WP_PLUGIN_DIR . '/gestion_boisson/';

    if (is_archive() && get_post_type($post) == 'boisson') {
        $archive_template = $plugin_root_dir . '/template/archive-boisson.php';
    }
    return $archive_template;
}
// ====================================================================================================================

