const swiper1 = new Swiper(".swiper" , {
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