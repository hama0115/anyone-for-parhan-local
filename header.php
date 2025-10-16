<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">
  
  <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>
    <?php wp_body_open(); ?>
    <header class="header">
      <div class="header-inner">
        <div class="header-logo-area">
          <a href="<?php echo esc_url(home_url('/')); ?>" class="header-logo">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/header-logo.svg" alt="Logo" />
          </a>
        </div>  

        <button class="btn-menu"></button>
        <?php if (has_nav_menu( 'menu-1') ): ?>
          <nav class="site-menu">
            <?php
            wp_nav_menu(
              [
                'container' => 'false',
                'theme_location' => 'menu-1'
              ]
            );
            ?>
          </nav>
        <?php endif; ?>

        <!-- 目次パネル -->
        <?php get_template_part( 'tmp/toc-panel' ) ?>

        <!-- 検索フォーム -->
        <?php get_template_part( 'tmp/searcharea' ) ?>
      </div>
    </header>