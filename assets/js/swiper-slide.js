//swiper.jsのまとめ
//swiperの基本クラスは必ず付与した上で、任意のクラスを付与すること

// 個別投稿のまとめのスライダー
const swiper1 = new Swiper(".top-gallery" , { //".swiper"はクラス名。「.」が抜けないように注意
  //フェード効果
  effect: 'fade',
  fadeEffect: {
    crossFade: true
  },
  //スライドが切り替わるときのスピード
  speed: 2000,
  //ページネーション
  pagination: {
    el: ".swiper-pagination"
  },
  //ナビゲーションボタンを有効に
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev"
  },
  //ループ
  loop: true,
  //オートプレイ
  autoplay: {
  delay: 3000, //3秒ごと
  disableOnIntersection: false //ユーザーの操作があっても自動再生を継続
  }
});

// 飲食店ごとのスライダーの初期化
document.querySelectorAll(".restaurant-slider").forEach((sliderEl) => { //条件に一致するすべてを探し出し、それぞれについてループ
  new Swiper(sliderEl, {
    slidesPerView: 2,
    spaceBetween: 30,
    slidesPerGroup: 2,
    pagination: {
      el: sliderEl.querySelector(".swiper-pagination"), // sliderEl を基準に検索
      clickable: true,
    },
    navigation: {
      nextEl: sliderEl.querySelector(".swiper-button-next"), // sliderEl を基準に検索
      prevEl: sliderEl.querySelector(".swiper-button-prev"), // sliderEl を基準に検索
    },
    loop: true,
    autoplay: {
      delay: 3000,
    },
    //spaceBetween: 30,
  });
});