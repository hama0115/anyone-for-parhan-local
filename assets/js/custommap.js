function initMap() {
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 16,
    center: { lat: 35.6792227, lng: 139.80513297370942 },
    mapId: '42e4a02c987a2573d8e4be12'
  });

  const markers = [];

  // ACFデータのデバッグ
  console.log('window.mapSpots:', window.mapSpots);

  if (window.mapSpots && Array.isArray(window.mapSpots) && window.mapSpots.length > 0) {
    window.mapSpots.forEach((spot, index) => {
      console.log(`Processing spot ${index}:`, spot);

      // 座標の取得（複数のフィールド名に対応）
      const lat = parseFloat(spot.lat || spot.latitude);
      const lng = parseFloat(spot.lng || spot.longitude);
      const name = spot.name || spot.title || `Spot ${index + 1}`;

      // 座標が有効かチェック
      if (isNaN(lat) || isNaN(lng)) {
        console.warn(`Invalid coordinates for spot ${index}:`, spot);
        return;
      }

      // カスタムマーカーコンテンツの作成
      let markerContent = null;
      let marker = null;

      if (spot.photo && spot.name) {
        // 画像+名前タグのカスタムマーカー作成
        const markerImg = document.createElement('img');
        markerImg.className = 'img-tag';
        markerImg.src = spot.photo;

        const markerNameTag = document.createElement('div');
        markerNameTag.className = 'name-tag';
        markerNameTag.textContent = spot.name;

        // 画像と名前タグを包含するコンテナ
        const markerContainer = document.createElement('div');
        markerContainer.className = 'gm__info';
        
        // コンテナに画像と名前タグを追加
        markerContainer.appendChild(markerImg);
        markerContainer.appendChild(markerNameTag);

        markerContent = markerContainer;
      }

      // マーカー作成
      if (markerContent) {
        // カスタムコンテンツ付きAdvancedMarkerElement
        marker = new google.maps.marker.AdvancedMarkerElement({
          map: map,
          position: { lat, lng },
          content: markerContent,
          title: name,
        });
      } else {
        // 標準マーカー
        marker = new google.maps.marker.AdvancedMarkerElement({
          position: { lat, lng },
          map: map,
          title: name,
        });
      }

      // 画像や説明をinfoWindowで表示
      const content =`
        <div style="max-width:250px">
          ${spot.photo ? `<img src="${spot.photo}" alt="${name}" style="width:100%;border-radius:8px;margin-bottom:10px">` : ''}
          <h3 style="margin:0 0 10px 0;font-size:16px;">${name}</h3>
          ${spot.desc ? `<p style="margin:0;font-size:14px;line-height:1.5;">${spot.desc}</p>` : ''}          
        </div>
      `;
      const infoWindow = new google.maps.InfoWindow( { content } );

      marker.addListener("click", () => {
        infoWindow.open({
          anchor: marker,
          map: map,
        });
      });
      markers.push(marker);
    });

    // マーカークラスタリングを追加
    if (markers.length > 0) {
      new markerClusterer.MarkerClusterer({
        map,
        markers,
      });
    } else {
      console.log('No valid markers created');
    }
  } else {
    console.log('No mapSpots data found or empty array');
  }
}

// DOMContentLoadedイベントで初期化
document.addEventListener('DOMContentLoaded', function() {
  // 少し遅延させてから初期化（ACFデータの読み込みを待つ）
  setTimeout(function() {
    if (typeof google !== 'undefined' && google.maps) {
      initMap();
    } else {
      console.error('Google Maps API not loaded');
    }
  }, 500);
});

//メモ
//(清澄白河の経緯) 35.6792227, 139.8019834
//(「KOFFEE MAMEYA Kakeru」の緯度経度) 35.676480133908754, 139.80428441394707
//(「オールプレスエスプレッソ」の緯度経度) 35.67776094983446, 139.80518018209077
//(「ブルーボトルコーヒー」の緯度経度) 35.677790948642276, 139.80058748430574
//(「洋食屋POND」の緯度経度)35.67973018612079, 139.80174907972332
//(「築地やまの」の緯度経度) 35.679227687817, 139.80105802495973
//(「3000日かけて完成させた極上ハンバーガーField」の緯度経度) 35.679349724907816, 139.80641432987576
//(「ハンバーガーfield」の緯度経度) 35.679334184609, 139.80641123999473
//(「le bois」の緯度経度) 35.67981087178964, 139.80473127766035
//(「清澄白河フジ丸醸造所」の緯度経度) 35.67907490868437, 139.8025632035447
//(「あやめ」の緯度経度) 35.67963040944622, 139.80127189488556