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

//スタイルシート、スクリプトを追加(CSS、JSの読み込み)
function enqueue_scripts() {
  //リセットCSSの読み込み
  wp_enqueue_style('reset-css', get_stylesheet_directory_uri() . '/assets/css/reset.css');
  //style.cssの読み込み
  wp_enqueue_style('main-css', get_stylesheet_uri());
  //swiper(CDN)のCSSの読み込み
  wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
  //ハンバーガーメニューの読み込み
  wp_enqueue_script('hamburger-menu', get_stylesheet_directory_uri() . '/assets/js/btn-menu.js', [], '1.0', true);
  //adobeフォントの読み込み
  wp_enqueue_script('adobefont', get_stylesheet_directory_uri() . '/assets/js/adobefont.js', [], '1.0', true);
  //swiper(CDN)のJSの読み込み
  wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js');
  //swiper.jsの読み込み
  wp_enqueue_script('swiper-slide-js', get_stylesheet_directory_uri() . '/assets/js/swiper-slide.js', [], '1.0', true);

  //個別投稿の場合のjsの読み込み
  if ( is_singular() ) {
    wp_enqueue_script('google-map-api', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCGatra0HuPCJJbTX2poBI-CbErfTyMe1Y', [], '1.0', true);
    wp_enqueue_script('googlemap', get_stylesheet_directory_uri() . '/assets/js/googlemap.js', [], '1.0', true);
  }
}
add_action('wp_enqueue_scripts', 'enqueue_scripts');

//ACF「googleマップ」を出力できるようにする
function my_acf_google_map_api( $api ){
  $api['key'] = 'AIzaSyCGatra0HuPCJJbTX2poBI-CbErfTyMe1Y';
  return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

//カスタムブロックの登録
add_action( 'init', 'register_acf_blocks' );
function register_acf_blocks() {
  register_block_type( __DIR__ . '/acf-blocks/parking-meter' );
  register_block_type( __DIR__ . '/acf-blocks/restaurant-info' );
}

//ACFブロックカテゴリーの登録
add_filter('block_categories_all', function ($categories) {
  $new_category = [
      'slug' => 'acf-block',
      'title' => 'ACFブロック',
  ];
  
  array_splice($categories, 1, 0, [$new_category]);
  
  return $categories;
});

//ブロックエディターにCSSを読み込む
add_action('after_setup_theme', 'my_editor_support');
function my_editor_support()
{
  add_theme_support('editor-styles');
  add_editor_style('assets/css/editor-style.css');
}