<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?> >
    <header class="header">
      <div class="header-inner">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="header-logo"><?php bloginfo('name'); ?></a>
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
      </div>
    </header>