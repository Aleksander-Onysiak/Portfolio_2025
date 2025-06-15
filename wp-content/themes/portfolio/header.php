<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <meta http-equiv="x-ua-compatible" content="ie=edge"/>

  <title><?= wp_title('-', false, 'right') . get_bloginfo('name') ?></title>
  <link rel="alternate" href="<?= __hdc("https://portfolio-2025.aleksanderonysiak.be/en/") ?>" hreflang="<?= __hdc("en") ?>" />

  <!-- Lien vers ma feuille de style css minifier -->
  <link rel="stylesheet" type="text/css" href="<?= dw_asset('css') ?>">
  <!-- Lien vers mon script js minifier -->
  <script src="<?= dw_asset('js') ?>" defer></script>

  <!-- META BASE -->
  <meta name="description" content="<?= __hdc("Portfolio de Aleksander Onysiak, développeur web. Portfolio démontrant mes capacités dans le web.") ?>"/>
  <meta itemprop="name" content="<?= __hdc("Portfolio de Aleksander Onysiak, développeur web") ?>"/>
  <meta name="author" content="Aleksander Onysiak"/>
  <meta name="keywords" content="<?= __hdc("Portfolio, Développeur web,Aleksander Onysiak, Accessibilité, Contact") ?>"/>

  <!-- meta OpenGraph -->
  <meta property="og:title" content="<?= get_the_title() ?> - <?= get_bloginfo('name'); ?>"/>
  <meta property="og:description" content="<?= __hdc("Portfolio de Aleksander Onysiak, développeur web. Portfolio démontrant mes capacités dans le web.") ?>"/>
  <meta property="og:locale" content="fr_BE"/>
  <meta property="og:type" content="website"/>
  <meta property="og:site_name" content="<?= __hdc("Aleksander Onysiak - Développeur Web") ?>"/>
  <meta property="og:url" content="https://portfolio-2025.aleksanderonysiak.be"/>
  <link rel="canonical" href="https://portfolio-2025.aleksanderonysiak.be" />
  <meta property="article:modified_time" content="2025-06-15:00:00+00:00"/>
  <meta name="twitter:site" content="@heardcase" />
  <meta name="twitter:creator" content="@heardcase" />

  <!-- FAVICON -->
  <link rel="icon" type="image/png" href="/wp-content/themes/portfolio/src/img/favicon-96x96.png" sizes="96x96" />
  <link rel="icon" type="image/svg+xml" href="/wp-content/themes/portfolio/src/img/favicon.svg" />
  <link rel="shortcut icon" href="/wp-content/themes/portfolio/src/img/favicon.ico" />
  <link rel="apple-touch-icon" sizes="180x180" href="/wp-content/themes/portfolio/src/img/apple-touch-icon.png" />
  <meta name="apple-mobile-web-app-title" content="Portfolio - Aleksander Onysiak" />
  <link rel="manifest" href="/wp-content/themes/portfolio/src/img/site.webmanifest" />
</head>

<body class="body">
<h1 class="sr-only"><?= get_the_title() ?></h1>

<?php
$activePage = get_field('active_page');
?>

<header class="header">
  <nav class="nav">
    <h2 class="sr-only nav_h">Menu principal</h2>
    <input type="checkbox" id="menu-toggle" class="nav__toggle"/>
    <label for="menu-toggle" class="nav__burger" aria-label="Ouvrir le menu">
      <span></span><span></span><span></span>
    </label>
    <ul class="nav__container">
      <?php foreach (dw_get_navigation_links('header') as $link): ?>
        <li class="nav__container_item">
          <a title="<?= $link->title; ?>" href="<?= $link->href; ?>" <?php if ($link->target !== "") {
            echo "target='$link->target'";
          } ?>
             class="nav__container_link <?= $activePage === $link->label ? 'nav__container_link--active' : ''; ?> <?= $link->class ?>"><?= $link->label; ?></a>
        </li>
      <?php endforeach; ?>
    </ul>
  </nav>
</header>

<main>
