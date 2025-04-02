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

//ACF「パーキングメーター情報」をショートコードで出力できるようにする([acf_parking_info]で出力)
function parking_info_shortcode() {
  ob_start();
  include get_stylesheet_directory() . '/tmp/parking-info-table.php';
  return ob_get_clean();
}
add_shortcode('acf_parking_info','parking_info_shortcode');

//ACF「飲食店情報」をショートコードで出力できるようにする([acf_parking_info]で出力)
function restaurant_info_shortcode() {
  ob_start();
  include get_stylesheet_directory() . '/tmp/restaurant-info-table.php';
  return ob_get_clean();
}
add_shortcode('acf_restaurant_info','restaurant_info_shortcode');