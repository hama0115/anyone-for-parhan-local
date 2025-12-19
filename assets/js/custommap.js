//全体用のマーカーつきgooglemap用のJS

function initMap() {
  const mainMap = new google.maps.Map(document.getElementById("map"), {
    zoom: 16,
    center: {
      lat: parseFloat(window.mapCenter.lat),
      lng: parseFloat(window.mapCenter.lng)
    },
    mapId: '42e4a02c987a2573d8e4be12'
  });

  const markers = [];

  // ACFデータのデバッグ
  console.log('window.mapSpots:', window.mapSpots);

  if (window.mapSpots && Array.isArray(window.mapSpots) && window.mapSpots.length > 0) {
    window.mapSpots.forEach((spot, index) => { //配列の各要素を「spot」として渡す
      console.log(`Processing spot ${index}:`, spot);

      // 座標の取得（複数のフィールド名に対応）
      const lat = spot["marker-spot"] && spot["marker-spot"].lat ? parseFloat(spot["marker-spot"].lat) : null; //三項演算子を使ってif文を使う
      const lng = spot["marker-spot"] && spot["marker-spot"].lng ? parseFloat(spot["marker-spot"].lng) : null;
      const name = spot.name || spot.title || `Spot ${index + 1}`;

      // カスタムマーカーコンテンツの作成
      let markerContent = null;
      let marker = null;

      if (spot.photo && spot.name) { //「「photo」、「name」はACFで設定したフィールド名。「spot」はforEachで渡された要素
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
          map: mainMap,
          position: { lat, lng },
          content: markerContent,
          title: name,
        });
      } else {
        // 標準マーカー
        marker = new google.maps.marker.AdvancedMarkerElement({          
          map: mainMap,
          title: name,
        });
      }

      // 画像や説明をinfoWindowで表示
      const content =`
        <div>
          ${spot.photo ? `<img src="${spot.photo}" alt="${name}" style="width:100%;border-radius:8px;margin-bottom:10px">` : ''}
          <h3 style="margin:0 0 10px 0;font-size:16px;">${name}</h3>
          ${spot.desc ? `<p style="margin:0;font-size:14px;line-height:1.5;">${spot.desc}</p>` : ''}          
        </div>
      `;
      const infoWindow = new google.maps.InfoWindow( { content } );

      marker.addListener("click", () => {
        infoWindow.open({
          anchor: marker,
          map: mainMap,
        });
      });
      markers.push(marker);
    });

    // マーカークラスタリングを追加
    if (markers.length > 0) {
      new markerClusterer.MarkerClusterer({
        map: mainMap,
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