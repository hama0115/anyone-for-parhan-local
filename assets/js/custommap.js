function initMap() {
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 16,
    center: window.mapCenter,
    mapId: '42e4a02c987a2573d8e4be12'
  });

  const markers = [];

  // ACFデータのデバッグ
  console.log('window.mapSpots:', window.mapSpots);

  if (window.mapSpots && Array.isArray(window.mapSpots) && window.mapSpots.length > 0) {
    window.mapSpots.forEach((spot, index) => {
      console.log(`Processing spot ${index}:`, spot);

      // 座標の取得（複数のフィールド名に対応）
      const lat = parseFloat(spot["marker-spot"]?.lat)
      const lng = parseFloat(spot["marker-spot"]?.lng)
      const name = spot.name || spot.title || `Spot ${index + 1}`;

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
//(清澄白河の緯度経度) 35.67944194627435, 139.80003451261462
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
// (「だるま」の緯度経度) 35.68108232680474, 139.8035039559188
// (「松葉鮨」の緯度経度) 35.6807126627983, 139.80650439491484
// (「うどん家族 小進庵」の緯度経度) 35.68066071041155, 139.80688195788716
// (「山の上」の緯度経度) 35.68193510244568, 139.80387281401636
// (「MAKIN」の緯度経度) 35.6821267704519, 139.80459274297124
// (「ヒキダシカフェ」の緯度経度) 35.68294318672116, 139.80493719399504
// (「First Crop Coffee Japan」の緯度経度) 35.68301373667506, 139.80279594068324
// (「Maison heureux（メゾンウル）」の緯度経度) 35.682639573926814, 139.80228028233333
// (「梅仁」の緯度経度) 35.682159150835474, 139.80263538098887
// (「中華料理 桃太楼」の緯度経度) 35.68006848209816, 139.7994327818992
// (「+Angle coffee works」の緯度経度) 35.68007249628492, 139.79958166621932
// (「fukadaso cafe」の緯度経度) 35.67869122632919, 139.80015947221568
// (「paraiso」の緯度経度) 35.67721270346049, 139.79737295028988
// (「Risosteria Trentatre」の緯度経度)35.677124261777024, 139.7972963110891
// (「ラフ」の緯度経度) 35.67709123664629, 139.79803923326395
// (「しょう栄」の緯度経度) 35.67536533659519, 139.79561414568622
// (「カレーカフェSINGA」の緯度経度) 35.676415165063304, 139.79518528467298
// (「らーめん こうかいぼう」の緯度経度) 35.67527764886333, 139.7987989304635
// (「B2ビースクエアード」の緯度経度) 35.67739904165859, 139.79709958742927
// (「千疋屋」の緯度経度) 35.67752635801482, 139.79725628785903
// (「コトリパン」の緯度経度) 35.67823809253661, 139.79430420753278
// (「」の緯度経度)
// (「」の緯度経度)
// (「」の緯度経度)
// (「」の緯度経度)
// (「」の緯度経度)