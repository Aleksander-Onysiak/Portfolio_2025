<?php

use Portfolio_Theme\Form\ContactForm;

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

// Charger les traductions
function hdc_trad_load_textdomain(): void
{
  load_theme_textdomain('hdc-trad', get_template_directory() . '/locales');
}
add_action('after_setup_theme', 'hdc_trad_load_textdomain');

function __hdc(string $translation, array $replacements = [])
{
  $base = __($translation, 'hdc-trad');

  foreach ($replacements as $key => $value) {
    $variable = ':' . $key;
    $base = str_replace($variable, $value, $base);
  }
  return $base;
}

// Supprimer les wysywig de base de wordpress
function init_remove_support(): void
{
  remove_post_type_support('post', 'editor');
  remove_post_type_support('page', 'editor');
  remove_post_type_support('product', 'editor');
}
add_action('init', 'init_remove_support', 100);

// Permet d'ajouter la possibilité d'uploader des extensions de fichiers non compatibles de base.
// Exemple : ici nous ajoutons le format SVG en tant que type d'image compatible pour l'upload.
function my_own_mime_types($mimes)
{
  // Ajout du mime type pour les fichiers SVG
  $mimes['svg'] = 'image/svg+xml';

  // Retourne le tableau des types MIME mis à jour
  return $mimes;
}

add_filter('upload_mimes', 'my_own_mime_types');

register_taxonomy('project_type', ['project'], [
  'labels' => [
    'name' => 'Types de projets',
    'singular_name' => 'Type de projet',
    'menu_name' => 'Types de projet',
    'all_items' => 'Tous les types',
    'edit_item' => 'Modifier le projet',
    'view_item' => 'Voir le type',
    'update_item' => 'Mettre à jour le type',
    'add_new_item' => 'Ajouter un nouveau type',
    'new_item_name' => 'Nom du nouveau type',
    'search_items' => 'Rechercher un type',
    'not_found' => 'Aucun type trouvé',
  ],
  'description' => 'Projets Design Web',
  'public' => true,
  'hierarchical' => true,
  'show_ui' => true,
  'show_admin_column' => true,
  'show_tagcloud' => false,
  'rewrite' => ['slug' => 'type-projet'],
]);

register_taxonomy('personal project', ['project'], [
  'labels' => [
    'name' => 'projet',
    'singular_name' => 'Projet Personnel'
  ],
  'description' => 'Description',
  'public' => true,
  'hierarchical' => true,
  'show_tagcloud' => false,
]);

register_taxonomy('school project', ['project'], [
  'labels' => [
    'name' => 'projet',
    'singular_name' => 'Projet Scolaire'
  ],
  'description' => '',
  'public' => true,
  'hierarchical' => true,
  'show_tagcloud' => false,
]);

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
    'supports' => [
      'title',
      'editor',
      'excerpt',
      'thumbnail',
    ],
  ]
);

// Activer l'utilisation des vignettes (image de couverture) sur nos post types:
add_theme_support('post-thumbnails', ['recipe', 'travel']);
add_action('admin_post_nopriv_portfolio_contact_form_submit', 'dw_handle_contact_form_submit');

function dw_contact_form_controller()
{
  new ContactForm($_POST);
}

add_action('admin_post_custom_contact_form', 'dw_contact_form_controller');

//enregistrer un menu de navigation, en fonction de l'endroit où ils sont exploités façon wordpress

register_nav_menu('header', 'Main navigation');
// Créer une nouvelle fonction qui permet de retourner un menu de navigation formaté en un
// tableau d'objets afin de pouvoir l'afficher à notre guise dans le templates.

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
    $link->title = $post->attr_title;
    $link->target = $post->target;
    $link->class = $post->classes[0];

    $links[] = $link;
  }

  return $links;
}


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

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('wp_head', 'wp_print_comments');
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('wp_head', 'wp_oembed_add_host_js');
remove_action('wp_head', 'rest_output_link_wp_head');
remove_action('wp_head', 'wp_generator');

//enqueue_assets_from_vite_manifest();
function dw_asset_logo()
{
  $manifest_path = get_template_directory() . '/dist/.vite/manifest.json';
  if (!file_exists($manifest_path)) {
    return '';
  }

  $manifest = json_decode(file_get_contents($manifest_path), true);

  $key = 'wp-content/themes/portfolio/src/img/logo.png';

  if (!isset($manifest[$key]['file'])) {
    return '';
  }

  return get_template_directory_uri() . '/dist/' . $manifest[$key]['file'];
}


// 1. Charger un fichier "public" (asset/image/css/script/...) pour le front-end sans que cela ne s'applique à l'admin.
function dw_asset(string $file): string
{
  $manifestPath = get_theme_file_path('dist/.vite/manifest.json');

  if (file_exists($manifestPath)) {
    $manifest = json_decode(file_get_contents($manifestPath), true);

    if (isset($manifest['wp-content/themes/portfolio/src/js/main.js']) && $file === 'js') {
      return get_theme_file_uri('dist/' . $manifest['wp-content/themes/portfolio/src/js/main.js']['file']);
    }

    if (isset($manifest['wp-content/themes/portfolio/src/css/style.scss']) && $file === 'css') {
      return get_theme_file_uri('dist/' . $manifest['wp-content/themes/portfolio/src/css/style.scss']['file']);
    }
  }

  return get_template_directory_uri() . '/dist/' . $file;
}

/////
function responsive_image($image, $settings): bool|string
{
  if (empty($image)) {
    return '';
  }

  $image_id = '';

  if (is_numeric($image)) {
    $image_id = $image;
  } elseif (is_array($image) && isset($image['ID'])) {
    $image_id = $image['ID'];
  } else {
  }

  $alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
  $image_post = get_post($image_id);
  $title = $image_post->post_title ?? '';
  $name = $image_post->post_name ?? '';

  $src = wp_get_attachment_image_url($image_id, 'full');
  $srcset = wp_get_attachment_image_srcset($image_id, 'full');
  $sizes = wp_get_attachment_image_sizes($image_id, 'full');

  $lazy = $settings['lazy'] ?? 'eager';

  $classes = '';
  if (!empty($settings['classes'])) {
    $classes = is_array($settings['classes']) ? implode(' ', $settings['classes']) : $settings['classes'];
  }

  ob_start();
  ?>
  <picture>
    <img
            src="<?= esc_url($src) ?>"
            alt="<?= esc_attr($alt) ?>"
            loading="<?= esc_attr($lazy) ?>"
            srcset="<?= esc_attr($srcset) ?>"
            sizes="<?= esc_attr($sizes) ?>"
            class="<?= esc_attr($classes) ?>">
  </picture>
  <?php
  return ob_get_clean();
}
