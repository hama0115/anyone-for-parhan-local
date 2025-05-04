const swiper1 = new Swiper(".swiper" , {
  //ページネーション
  pagination: {
    el: ".swiper-pagination"
  },
  //ナビゲーションボタンを有効に
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev"
  }
});