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
  //Luminous(CDN)のCSSの読み込み(style.cssより上に)
  wp_enqueue_style('luminous-css', 'https://cdn.jsdelivr.net/npm/luminous-lightbox@2.4.0/dist/luminous-basic.min.css');
  //style.cssの読み込み
  wp_enqueue_style('main-css', get_stylesheet_uri());
  //swiper(CDN)のCSSの読み込み
  wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');

  //ハンバーガーメニューの読み込み
  wp_enqueue_script('hamburger-menu', get_stylesheet_directory_uri() . '/assets/js/btn-menu.js', [], '1.0', true);
  //fontawesomeの読み込み
  wp_enqueue_script('fontawesome-kit', 'https://kit.fontawesome.com/9ab3ae9094.js', array(), null, true);
  //adobeフォントの読み込み
  wp_enqueue_script('adobefont', get_stylesheet_directory_uri() . '/assets/js/adobefont.js', [], '1.0', true);
  //swiper(CDN)のJSの読み込み
  wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js');
  //swiper.jsの読み込み
  wp_enqueue_script('swiper-slide-js', get_stylesheet_directory_uri() . '/assets/js/swiper-slide.js', [], '1.0', true);
  //追従スクロール用のjSの読み込み
  wp_enqueue_script('scroll.js', get_stylesheet_directory_uri() . '/assets/js/scroll.js', [], '1.0', true);
  //GSAPの読み込み
  wp_enqueue_script('gsap', 'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js', [], '1.0', true);
  //scrollTriggerの読み込み
  wp_enqueue_script('scrolltrigger', 'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js', [], '1.0', true);
  //「Luminous」の読み込み
  wp_enqueue_script('luminous-cdn', 'https://cdn.jsdelivr.net/npm/luminous-lightbox@2.4.0/dist/luminous.min.js', [], '1.0', true);
  //ライブラリ「luminous」用の実際のjSの読み込み
  wp_enqueue_script('luminous.js', get_stylesheet_directory_uri() . '/assets/js/luminous.js', ['luminous-cdn'], '1.0', true);

  //googleマップAPIとgooglemap.js(ACF用)の読み込み(APIのために必要。先に読み込む)
  wp_enqueue_script('google-map-api', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCGatra0HuPCJJbTX2poBI-CbErfTyMe1Y&libraries=marker', [], '1.0', true);
  wp_enqueue_script('googlemap', get_stylesheet_directory_uri() . '/assets/js/googlemap.js', ['jquery'], '1.0', true);

  //(全体用)googlemapjjsapiのカスタムjs
  wp_enqueue_script('custommap.js', get_stylesheet_directory_uri() . '/assets/js/custommap.js', ['google-map-api'], '1.0', true);
  //(個別PM用)googlemapjjsapiのカスタムjs
  wp_enqueue_script('parkingmeter-custommap.js', get_stylesheet_directory_uri() . '/assets/js/parkingmeter-custommap.js', ['google-map-api'], '1.0', true);

  //マーカークラスタリングライブラリの読み込み
  wp_enqueue_script('marker-cdn', 'https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js', [], '1.0', true);

  //個別投稿の場合のjsの読み込み
  if ( is_singular() ) {
    //lwptoc.jsの読み込み
    wp_enqueue_script('lwptoc', get_stylesheet_directory_uri() . '/assets/js/lwptoc.js', [], '1.0', true);
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

//コメント欄のカスタマイズ。URL、メールアドレス、クッキーを削除。
function remove_comment_fields($fields) {
  unset($fields['url']);
  unset($fields['email']);
  unset($fields['cookies']);
  return $fields;
}
add_filter('comment_form_default_fields', 'remove_comment_fields');

//抜粋の文字数制限を設定
add_filter( 'excerpt_length', function( $length ){
  return 50;
}, 999 );

//省略記号を変更
add_filter( 'excerpt_more', function( $more ){
  return '<i class="fa-solid fa-circle-arrow-right"></i>';
}, 999);