// 個別投稿のまとめのスライダー
const swiper1 = new Swiper(".swiper" , { //".swiper"はクラス名
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

// 飲食店ごとのスライダー
const swiper2 = new Swiper("restaurant-slider", {
  //2枚同時に表示させる
  slidesPerView: 2,

  //スライドするときも2枚単位で
  slidesPerGroup: 2,

  pagination: {
    el: "restaurant-slider-pagination",
    clickable: true,
  },
  //ナビゲーションボタンを有効に
  navigation: {
    nextEl: ".restaurant-slider-next",
    prevEl: ".restaurant-slider-prev"
  },

  //ループ
  loop: true,
  //オートプレイ
  autoplay: {
  delay: 3000, //3秒ごと
  }
});