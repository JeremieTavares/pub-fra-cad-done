<?php
// ==========================================================
// Ceci permet de lier notre fichier CSS
wp_enqueue_style('style', get_template_directory_uri() . '/style.css');
// ==========================================================

// ==========================================================
// Permet d'ajouter un title dynamique a nos page comme si on avait le tag <title> dans notre head
add_theme_support('title-tag');
// ==========================================================

// ==========================================================
// Ceci permet d'afficher l'image the thumbnail sur une page avec la function: the_post_thumbnail();
// ***NOUVELLE NORME DE WP***
add_theme_support('post-thumbnails');
set_post_thumbnail_size(200, 200);
// ==========================================================





// ====================================================================================================================
// Ceci permet de cree un menu custom dans la sidebar de Wordpress et un ***MENU DE NAVIGATION SUR LE SITE***
// add_theme_support et menus en params ajouter un menu. Dautres types de params sont possible
add_theme_support('menus'); // Ajoute le type 'menus' dans apparence/ du panel Admin

add_action('after_setup_theme', 'register_my_menu'); // Ce hook execute la function ci-dessous qui elle cree le menu de navigation

function register_my_menu()
{
    register_nav_menu('main-menu', 'Menu principal');
} // 1PARAM LOCATION DU MENU / 2 PARAM LE NOM DU MENU

// ====================================================================================================================





// ====================================================================================================================
// ajoute un « hook » lors de l’affichage du menu afin d’ajouter notre page d’optio
add_action('admin_menu', 'addMenu');
// NOM DU HOOK / FUNCTION A CALL

// la fonction addMenu() identifiée dans le hook précédent.
function addMenu()
{
    add_menu_page(
        'Mes options', //Titre de la page menu
        'Mes options', //Titre du menu
        'manage_options', //Quel fonctionnalitees peut t'il faire
        'mes_options', // Slug du menu
        'createMesOptionsPage' // Function a call qui gere le menu
    );
}
//  FUNCTION QUI CONTIENT LES CHAMPS DU FORM PERMETTANT LA MODIFICATION
function createMesOptionsPage()
{
?>
    <h1>Paramètres du site</h1>
    <form action="options.php" method="POST">
        <?php
        settings_fields('mes_options'); // Met le nom du premier params de mes register_settings()

        do_settings_sections('mes_options'); // Afficher toutes les sections et inputs fait plus bas

        submit_button(); // Bouton envoye pour enregistrer dans la BD les modifications
        ?>
    </form>
<?php
}

// ===============





// ===============
// CECI EST POUR AJOUTER DES OPTIONS/CHAMPS DANS NOTRE PAGE OPTION CUSTOM
add_action('admin_init', 'registerMySettings');


function registerMySettings()
{

    // ===============
    register_setting(/*$id */'mes_options', /*$id */ 'url_banner_id');

    add_settings_section(
        /*$id */
        'mes_options_pub_menu', // LINK WITH SECTION IN SETTINGS FIELD
        /*$title */
        'Parametres', // Titre de ma section affiche a lecran
        /*$callback */
        'sectionToModifyWebsite', // Nom de la function qui va gerer laffichage des TITRES etc..
        /*$page */
        'mes_options' // sur quel page doption je veux ajouter cela
    );


    //- add_setting_field() permet d’ajouter un nouveau champ dans le formulaire.
    add_settings_field(
        /*$id */
        'url_banner_id', //JE DOIT LINK CE ID A MON INPUT NAME, mettre le mm nom que celui dans register_settings();
        /*$title */
        "URL de l'image en banniere: ", // titre de cet input , genre de LABEL
        /*$callback */
        'modifyBannerURL',  // Le nom de la function que je vais cree en bas pour faire les inputs etc
        /*$page */
        'mes_options', // le nom de la page que je veux cree cette option en format slug
        /*$section */
        'mes_options_pub_menu', // Ceci est lie au ID de la function: add_settings_section RELIER A OU ON VX LA METTRE ***** CHANGER LE NOM PAR RAPPORT A KEL SECTION JE VX LE METTRE, COMMEN LA SECTION PLUS HAUT EST COMMENT-OUT JE VAIS LE METTRE DANS LA MM SECTION QUE LE TEXT AREA, MAIS SI LE FORMULAIRE AURAIT COMPORTER DES TYPE DE DONNE DIFFERANTE JE LAURAIS DANS UNE SECTION DIFFERANTE, JUSTE PAS OUBLIE DE CHANGER LA SECTION POUR CELLE CREE DANS LE ADD_SETTINGS_SECTION() ET METTRE L ID DE CETTE SECTION POUR LES LIE ENSEMBLE
        /*$ARRAY / LABEL FOR and CSS CLASS */                                                                       // mes_options_couleurs_section, SI JE DE-COMMENT LA SECTION COULEUR JE MET CA
    );

    // ===============

    register_setting(/*$id */'mes_options', /*$id */ 'facebook_img_url');

    add_settings_field(
        /*$id */
        'facebook_img_url',
        /*$title */
        "URL Facebook Image: ",
        /*$callback */
        'modifyFacebookImgURL',
        /*$page */
        'mes_options',
        /*$section */
        'mes_options_pub_menu',
    );

    // ===============

    register_setting(/*$id */'mes_options', /*$id */ 'url_facebook_id');

    add_settings_field(
        /*$id */
        'url_facebook_id',
        /*$title */
        "URL Facebook: ",
        /*$callback */
        'modifyFacebookRedirection',
        /*$page */
        'mes_options',
        /*$section */
        'mes_options_pub_menu',
    );

    // ===============

    register_setting(/*$id */'mes_options', /*$id */ 'tel_id');

    add_settings_field(
        /*$id */
        'tel_id',
        /*$title */
        "Numero de téléphone: ",
        /*$callback */
        'modifyFooterTelInformation',
        /*$page */
        'mes_options',
        /*$section */
        'mes_options_pub_menu',
    );
    // ===============


    register_setting(/*$id */'mes_options', /*$id */ 'font_style_id');

    add_settings_field(
        /*$id */
        'font_style_id',
        /*$title */
        "Police General: ",
        /*$callback */
        'modifyFontStyle',
        /*$page */
        'mes_options',
        /*$section */
        'mes_options_pub_menu',
    );
    // ===============


    register_setting(/*$id */'mes_options', /*$id */ 'color_style_id');

    add_settings_field(
        /*$id */
        'color_style_id',
        /*$title */
        "Style du header et footer: ",
        /*$callback */
        'modifyHeaderFooterColorStyle',
        /*$page */
        'mes_options',
        /*$section */
        'mes_options_pub_menu',
    );
    // ===============

    register_setting(/*$id */'mes_options', /*$id */ 'li_id');

    add_settings_field(
        /*$id */
        'li_id',
        /*$title */
        "Style des boutons de navigation: ",
        /*$callback */
        'modifyMenuBoutonColorStyle',
        /*$page */
        'mes_options',
        /*$section */
        'mes_options_pub_menu',
    );


    // ===============
    register_setting(/*$id */'mes_options', /*$id */ 'a_link_id');

    add_settings_field(
        /*$id */
        'a_link_id',
        /*$title */
        "Style des liens dans les boutons de navigation: ",
        /*$callback */
        'modifyMenuLinkColorStyle',
        /*$page */
        'mes_options',
        /*$section */
        'mes_options_pub_menu',
    );
    // ===============



    // ===============
    register_setting(/*$id */'mes_options', /*$id */ 'footer_link_id');

    add_settings_field(
        /*$id */
        'footer_link_id',
        /*$title */
        "Style des liens dans le footer: ",
        /*$callback */
        'modifyFooterLinkStyle',
        /*$page */
        'mes_options',
        /*$section */
        'mes_options_pub_menu',
    );
    // ===============



};
// ====================================================================================================================





// ====================================================================================================================
//FUNCTION QUI A ETE CALL DANS add_settings_section() dans le callback, CETTE FONCTION AFFICHE UN TEXTE COMME UN FIELDSET
// contiendra simplement un echo qui guidera l’utilisateur sur ce qu’il peut faire dans cette page.
// Cest le $callback de la function add_settings_section
function sectionToModifyWebsite()
{
    echo "<h3>Completez les parametres de votre site ici.</h3>";
};

// ====================================================================================================================





// ====================================================================================================================
// Cest le $callback de la function add_settings_field QUI MODIFIE LE PATH DE L'IMAGE DE BANNIERE DU SITE
//PAR BONNE PRATIQUE AJOUTER L'IMAGE VIA LE PANEL MEDIA DE WP ET COPIER LE PATH DONNER PAR MEDIA ET LE METTRE DANS L'INPUT 
//(mentionne le path a recuperer pour afficher l'image en banniere)
function modifyBannerURL()
{
?>
    <input type="text" id="url_banner_id" name="url_banner_id" value="<?= get_option('url_banner_id') ?>">
<?php
}
// ====================================================================================================================





// ====================================================================================================================
// Cest le $callback de la function add_settings_field QUI MODIFIE LE PATH DE L'IMAGE AFIN D'AFFICHER UNE NOUVELLE IMAGE
//PAR BONNE PRATIQUE AJOUTER L'IMAGE VIA LE PANEL MEDIA DE WP ET COPIER LE PATH DONNER PAR MEDIA ET LE METTRE DANS L'INPUT 
//(mentionne le path a recuperer pour afficher l'image desire en bas de page)
function modifyFacebookImgURL()
{
?>
    <input type="text" id="facebook_img_url" name="facebook_img_url" value="<?= get_option('facebook_img_url') ?>">
<?php
}
// ====================================================================================================================





// ====================================================================================================================
// Cest le $callback de la function add_settings_field QUI MODIFIE OU EST-CE QUE CA REDIRIGE
//L'UTILISATEUR LORSQU'IL CLICK SUR LE LOGO FACEBOOK (modifie l'url de redirection)
function modifyFacebookRedirection()
{
?>
    <input type="text" id="url_facebook_id" name="url_facebook_id" value="<?= get_option('url_facebook_id') ?>">
<?php
}
// ====================================================================================================================







// ====================================================================================================================
// Cest le $callback de la function add_settings_field QUI AFFICHE UN SELECT POUR MODIFIER LA FONT DU SITE WEB
function modifyFontStyle()
{
?>
    <select name="font_style_id" id="font_style_id">
        <option value="Arial" <?php
                                if (get_option('font_style_id') == "Arial")
                                    echo 'selected';
                                ?>>Arial</option>
        <option value="Calibri" <?php
                                if (get_option('font_style_id') == "Calibri")
                                    echo 'selected';
                                ?>>Calibri</option>
        <option value="Times New Roman" <?php
                                        if (get_option('font_style_id') == "Times New Roman")
                                            echo 'selected';
                                        ?>>Times New Roman</option>
    </select>
<?php
}
// ====================================================================================================================



// ====================================================================================================================
// Cest le $callback de la function add_settings_field QUI AFFICHE UN COLOR SELECTOR POUR MODIFIER LE STYLE DE COULEUR DU HEADER ET FOOTER

function modifyHeaderFooterColorStyle()
{
?>
    <input type="color" name="color_style_id" id="color_style_id" value="<?= get_option('color_style_id') ?>">
<?php
}
// ====================================================================================================================


// ====================================================================================================================
// Cest le $callback de la function add_settings_field QUI AFFICHE UN COLOR SELECTOR POUR MODIFIER LE STYLE DES LI

function modifyMenuBoutonColorStyle()
{
?>
    <input type="color" name="li_id" id="li_id" value="<?= get_option('li_id') ?>">
<?php
}
// ====================================================================================================================




// ====================================================================================================================
// Cest le $callback de la function add_settings_field QUI AFFICHE UN COLOR SELECTOR POUR MODIFIER LE STYLE DES LI

function modifyMenuLinkColorStyle()
{
?>
    <input type="color" name="a_link_id" id="a_link_id" value="<?= get_option('a_link_id') ?>">
<?php
}
// ====================================================================================================================


// ====================================================================================================================
// Cest le $callback de la function add_settings_field QUI AFFICHE UN COLOR SELECTOR POUR MODIFIER LE STYLE DE COULEUR DU HEADER ET FOOTER

function modifyFooterTelInformation()
{
?>
    <input type="tel" name="tel_id" id="tel_id" value="<?= get_option('tel_id') ?>">
<?php
}
// ====================================================================================================================



// ====================================================================================================================
// Cest le $callback de la function add_settings_field QUI AFFICHE UN COLOR SELECTOR POUR MODIFIER LE STYLE DE COULEUR DU HEADER ET FOOTER

function modifyFooterLinkStyle()
{
?>
    <input type="color" name="footer_link_id" id="footer_link_id" value="<?= get_option('footer_link_id') ?>">
<?php
}
// ====================================================================================================================






// ====================================================================================================================
// QUAND LA PAGE LOAD, CETTE FUNCTIONE EST CALL ET APPLIQUE LE STYLE DE FONT QUI EST ENREGISTRER DANS LA TABLE WP-OPTIONS
function admin_custom_font()
{
?>
    <style>
        * {
            font-family: <?= get_option('font_style_id'); ?>;
        }

        header,
        footer {
            background-color: <?= get_option('color_style_id'); ?>;
        }

        #primary-menu>li {
            background-color: <?= get_option('li_id'); ?>;
        }

        #primary-menu>li>a {
            color: <?= get_option('a_link_id'); ?>;
        }

        footer,
        footer>span:nth-of-type(2)>a {
            color: <?= get_option('footer_link_id'); ?>;
        }


        .imgBanner {
            background-image: linear-gradient(0deg, rgba(255, 255, 255, 0) 0%, rgba(42, 42, 42, 0.5518102240896359) 20%, rgba(0, 0, 0, 0.60699229691876746) 60%, rgba(50, 50, 50, 0.41911764705882) 90%, rgba(255, 255, 255, 0) 100%),
                url('<?= get_option("url_banner_id") ?> ');
            background-position: center;
            width: 100%;
            height: 400px;
            background-size: stretch;
            color: white;
        }


        .imgPlat {
            width: 25rem;
            height: 50%;
            border-radius: 5px;
        }
    </style>
<?php
}
add_action('wp_head', 'admin_custom_font'); // admin_head modifie aussi le font du WP-admin panel , pas juste le site
// ====================================================================================================================
