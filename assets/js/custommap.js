// Google Maps APIの読み込み完了後に実行
function initMap() {

  //清澄白河の位置を取得
  const map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: 35.6792227, lng: 139.80513297370942 },
    zoom: 16,
    mapId: '42e4a02c987a2573d8e4be12'
  });

  // AllpressEspressoのマーカー（PinElement使用）
  const pinBackground = new google.maps.marker.PinElement({
    background: '#ffa71a',
  });
  const marker1 = new google.maps.marker.AdvancedMarkerElement({
    map: map,
    position: { lat: 35.67776094983446, lng: 139.80518018209077 },
    title: "Allpress Espresso Tokyo Roastery & Cafe",
    content: pinBackground.element,
  });

  // ブルーボトルコーヒー清澄白河のマーカー
  const marker2 = new google.maps.Marker({
    position: { lat: 35.67788639959401, lng: 139.80058939615927 },
    map: map,
    title: "ブルーボトルコーヒー清澄白河",
  });

  // 洋食屋PONDのマーカー
   const marker3 = new google.maps.Marker({
    position: { lat: 35.67973018612079, lng: 139.80513297370942 },
    map: map,
    title: "洋食屋POND",
  });

  //築地やまの のマーカー
  const yamanoImg = document.createElement('img');
  yamanoImg.src = '/wp-content/themes/anyone-for-parhan/assets/img/yamano.jpeg';
  yamanoImg.style.width = '40px';
  yamanoImg.style.height = '40px';
  yamanoImg.style.border = 'solid 3px #fff';
  yamanoImg.style.borderRadius = '50%';
  const yamanoMarkerView = new google.maps.marker.AdvancedMarkerElement({
    map: map,
    position: { lat: 35.679227687817, lng:139.80105802495973 },
    content: yamanoImg,
    title: '築地やまの',
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
//(清澄白河の経緯) 35.6792227, 139.8019834
//(「オールプレスエスプレッソ」の経緯) 35.67776094983446, 139.80518018209077
//(「洋食屋POND」の経緯)35.67973018612079, 139.80174907972332
//(「築地やまの」の経緯) 35.679227687817, 139.80105802495973