<?php

if ( ! function_exists( 'anyonetheme_setup' )):
  function anyonetheme_setup() {
    //タイトルタグを出力
    add_theme_support('title-tag');

    //アイキャッチ画像を使う
    add_theme_support( 'post-thumbnails' );

    //ナビゲーションメニューを設定
    register_nav_menus(
      [
        'menu-1' => 'メインメニュー'
      ]
    );
  }
endif;
add_action( 'after_setup_theme', 'anyonetheme_setup' );

//スクリプト、スタイルシートを追加(JavaScript,CSS)
function enqueue_scripts() {
  //リセットCSSの読み込み
  wp_enqueue_style('reset-css', get_stylesheet_directory_uri() . '/assets/css/reset.css');
  //style.cssの読み込み
  wp_enqueue_style('main-css', get_stylesheet_uri());
  //ハンバーガーメニューの読み込み
  wp_enqueue_script('hamburger-menu', get_stylesheet_directory_uri() . '/assets/js/btn-menu.js', [], '1.0', true);
  //adobeフォントの読み込み
  wp_enqueue_script('adobefont', get_stylesheet_directory_uri() . 'assets/js/adobefont.js', [], '1.0', true);
}
add_action('wp_enqueue_scripts', 'enqueue_scripts');