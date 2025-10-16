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

      // カスタムマーカーコンテンツの作成（le boisスタイル）
      let markerContent = null;
      let marker = null;

      if (spot.photo && spot.name) {
        // 画像+名前タグのカスタムマーカー作成
        const markerImg = document.createElement('img');
        markerImg.className = 'img-tag';
        markerImg.src = spot.photo;
        markerImg.style.width = '40px';
        markerImg.style.height = '40px';
        markerImg.style.border = 'solid 3px #fff';
        markerImg.style.borderRadius = '50%';

        const markerNameTag = document.createElement('div');
        markerNameTag.className = 'name-tag';
        markerNameTag.textContent = spot.name;
        markerNameTag.style.backgroundColor = '#333';
        markerNameTag.style.color = '#fff';
        markerNameTag.style.padding = '4px 8px';
        markerNameTag.style.borderRadius = '4px';
        markerNameTag.style.fontSize = '12px';
        markerNameTag.style.whiteSpace = 'nowrap';

        // 画像と名前タグを包含するコンテナ
        const markerContainer = document.createElement('div');
        markerContainer.className = 'gm__info';
        markerContainer.style.display = 'flex';
        markerContainer.style.flexDirection = 'column';
        markerContainer.style.alignItems = 'center';
        markerContainer.style.gap = '5px';
        
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
        markers
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