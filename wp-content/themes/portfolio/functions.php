<?php

use Portfolio_Theme\Form\ContactForm;

function hepl_trad_load_textdomain(): void
{
    load_theme_textdomain('hepl-trad', get_template_directory() . '/locales');
}

add_action('after_setup_theme', 'hepl_trad_load_textdomain');

function __hepl(string $translation, array $replacements = [])
{
    $base = __($translation, 'hepl-trad');

    foreach ($replacements as $key => $value) {
        $variable = ':' . $key;
        $base = str_replace($variable, $value, $base);
    }
    return $base;
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once(__DIR__ . '/forms/ContactForm.php');

function dw_handle_contact_form_submit()
{
    (new DW_Theme\Forms\ContactForm())
        ->rule('name', 'required')
        ->rule('email', 'required')
        ->rule('email', 'valid_email')
        ->rule('subject', 'required')
        ->rule('message', 'required')
        ->rule('message', 'no_test')
        ->sanitize('name', 'sanitize_text_field')
        ->sanitize('email', 'sanitize_text_field')
        ->sanitize('subject', 'sanitize_text_field')
        ->sanitize('message', 'sanitize_text_field')
        ->handle($_POST);
}

//function __hepl(string $key): string
//{
//    return __($key, 'hepl-trad');
//}
//Disable Wordpress' default Gutenberg Editor:
add_filter('use_block_editor_for_post', '__return_false', 10);
// Disable Gutenberg on the back end.
add_filter('use_block_editor_for_post', '__return_false');
// Disable Gutenberg for widgets.
add_filter('use_widgets_block_editor', '__return_false');
add_action('wp_enqueue_scripts', function () {
    // Remove CSS on the front end.
    wp_dequeue_style('wp-block-library');
    // Remove Gutenberg theme.
    wp_dequeue_style('wp-block-library-theme');
    // Remove inline global CSS on the front end.
    wp_dequeue_style('global-styles');
}, 20);

add_theme_support('post-thumbnails', ['project']);

register_post_type('project', [
        'label' => 'Projets',
        'description' => 'Description des projets',
        'public' => true,
        'hierarchic' => 6,
        'menu_icon' => 'dashicons-welcome-view-site',
        'show_in_nav_menus' => true,
        'rewrite' => ['slug' => 'projets'],
        'has_archive' => true,
        'supports' => ['title', 'editor', 'excerpt', 'thumbnail',
        ],
    ]
);


// Charger les champs ACF exportés

// Activer l'utilisation des vignettes (image de couverture) sur nos post types:
add_theme_support('post-thumbnails', ['recipe', 'travel']);

function dw_asset(string $file): string
{
    return get_template_directory_uri() . '/dist/' . $file;
}

add_action('admin_post_nopriv_portfolio_contact_form_submit', 'dw_handle_contact_form_submit');

function dw_contact_form_controller()
{
    new ContactForm($_POST);
}

add_action('admin_post_custom_contact_form', 'dw_contact_form_controller');

//enregistrer un menu de navigation, en fonction de l'endroit où ils sont exploités façon wordpress

register_nav_menu('header', 'Main navigation');
// Créer une nouvelle fonction qui permet de retourner un menu de navigation formaté en un
// tableau d'objets afin de pouvoir l'afficher à notre guise dans le template.

function dw_get_navigation_links(string $location): array
{
    // Récupérer l'objet WP pour le menu à la location $location
    $locations = get_nav_menu_locations();

    if (!isset($locations[$location])) {
        return [];
    }

    $nav_id = $locations[$location];
    $nav = wp_get_nav_menu_items($nav_id);

    // Transformer le menu en un tableau de liens, chaque lien étant un objet personnalisé

    $links = [];

    foreach ($nav as $post) {
        $link = new stdClass();
        $link->href = $post->url;
        $link->label = $post->title;

        $links[] = $link;
    }

    // Retourner ce tableau d'objets (liens).

    return $links;
}

//ajouter un formulaire


function create_option_page()
{
    if (function_exists('acf_add_options_page')) {
        acf_add_options_page([
            'page_title' => 'Site Options',
            'menu_title' => 'Site Settings',
            'menu_slug' => 'site-options',
            'capability' => 'edit_posts',
            'redirect' => false
        ]);

        // Sous-pages
        acf_add_options_sub_page([
            'page_title' => 'Company Settings',
            'menu_title' => 'Company',
            'parent_slug' => 'site-options',
        ]);

        acf_add_options_sub_page([
            'page_title' => 'SEO Settings',
            'menu_title' => 'SEO',
            'parent_slug' => 'site-options',
        ]);
    }
}

add_action('acf/init', 'create_option_page');

