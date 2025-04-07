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
  //ハンバーガーメニューの読み込み
  wp_enqueue_script('hamburger-menu', get_stylesheet_directory_uri() . '/assets/js/btn-menu.js', [], '1.0', true);
  //adobeフォントの読み込み
  wp_enqueue_script('adobefont', get_stylesheet_directory_uri() . '/assets/js/adobefont.js', [], '1.0', true);

  //個別投稿の場合のjsの読み込み
  if ( is_singular() ) {
    wp_enqueue_script('google-map-api', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCGatra0HuPCJJbTX2poBI-CbErfTyMe1Y', [], '1.0', true);
    wp_enqueue_script('googlemap', get_stylesheet_directory_uri() . '/assets/js/googlemap.js', [], '1.0', true);
  }
}
add_action('wp_enqueue_scripts', 'enqueue_scripts');

//ACF「パーキングメーター情報」をショートコードで出力できるようにする([acf_parking_info]で出力)
function parking_info_shortcode() {
  ob_start();
  include get_stylesheet_directory() . '/tmp/parking-info-table.php';
  return ob_get_clean();
}
add_shortcode('acf_parking_info','parking_info_shortcode');

//ACF「スポット情報」をショートコードで出力できるようにする([acf_spot_info]で出力)
function spot_info_shortcode() {
  ob_start();
  include get_stylesheet_directory() . '/tmp/spot-info-table.php';
  return ob_get_clean();
}
add_shortcode('acf_spot_info','spot_info_shortcode');

//ACF「googleマップ」を出力できるようにする
function my_acf_google_map_api( $api ){
  $api['key'] = 'AIzaSyCGatra0HuPCJJbTX2poBI-CbErfTyMe1Y';
  return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

//ACF「飲食店情報」をショートコードで出力できるようにする([acf_parking_info]で出力)
function restaurant_info_shortcode() {
  ob_start();
  include get_stylesheet_directory() . '/tmp/restaurant-info-table.php';
  return ob_get_clean();
}
add_shortcode('acf_restaurant_info','restaurant_info_shortcode');