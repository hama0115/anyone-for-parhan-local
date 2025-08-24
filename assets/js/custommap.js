// Google Maps APIの読み込み完了後に実行
function initMap() {
  const map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: 35.68325920320933, lng: 139.7958471286717 },
    zoom: 15,
  });

  // オールプレスエスプレッソのマーカー
  const marker1 = new google.maps.Marker({
    position: { lat: 35.67835555735313, lng: 139.80513297370942 },
    map: map,
    title: "オールプレスエスプレッソ",
  });

  // ブルーボトルコーヒー清澄白河のマーカー
  const marker2 = new google.maps.Marker({
    position: { lat: 35.67788639959401, lng: 139.80058939615927 },
    map: map,
    title: "ブルーボトルコーヒー清澄白河",
  });
}

// DOMContentLoadedイベントで初期化
document.addEventListener('DOMContentLoaded', function() {
  // Google Maps APIが読み込まれているかチェック
  if (typeof google !== 'undefined' && google.maps) {
    initMap();
  } else {
    // Google Maps APIがまだ読み込まれていない場合、少し待ってから再試行
    setTimeout(function() {
      if (typeof google !== 'undefined' && google.maps) {
        initMap();
      }
    }, 1000);
  }
});

//メモ
//(清澄白河の経緯) 35.68325920320933, 139.7958471286717
//(「オールプレスエスプレッソ」の経緯) 35.67835555735313, 139.80513297370942