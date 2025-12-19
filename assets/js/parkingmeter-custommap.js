//個別PM用のマーカー付きgooglemap用のJS

function initParkingMeterMap(mapData) { //PHPから渡されたデータを引数にする
  console.log('initParkingMeterMap called with:', mapData);

  // データの妥当性チェック
  if (!mapData || !mapData.containerId) {
    console.error('parkingmeter-custommap: Invalid mapData', mapData);
    return;
  }

  // コンテナ取得
  const mapContainer = document.getElementById(mapData.containerId);
  
  if (!mapContainer) {
    console.error(`parkingmeter-custommap: Map containerが見つかりません: ${mapData.containerId}`);
    return;
  }

  // Google Maps API確認
  if (typeof google === 'undefined' || !google.maps || !google.maps.Map) {
    console.error('parkingmeter-custommap: Google Maps API not loaded');
    // APIが読み込まれるまで待つ
    setTimeout(() => initParkingMeterMap(mapData), 100);
    return;
  }

  // centerの確認
  if (!mapData.center || typeof mapData.center.lat !== 'number' || typeof mapData.center.lng !== 'number') {
    console.error('parkingmeter-custommap: Invalid center data', mapData.center);
    return;
  }

  // マップ作成
  try {
    const parkingMeterMap = new google.maps.Map(mapContainer, {
      zoom: 16, //マップの縮尺
      center: {
        lat: mapData.center.lat,
        lng: mapData.center.lng
      },
      mapId: '42e4a02c987a2573d8e4be12'
    });

    console.log('parkingmeter-custommap: マップ作成成功');

    const markers = [];

    // マーカーの処理
    if (mapData.spots && Array.isArray(mapData.spots) && mapData.spots.length > 0) {
      mapData.spots.forEach((spot, index) => {
        // 座標の取得（複数のフィールド名に対応）
        const lat = spot["marker-spot"] && spot["marker-spot"].lat ? parseFloat(spot["marker-spot"].lat) : null;
        const lng = spot["marker-spot"] && spot["marker-spot"].lng ? parseFloat(spot["marker-spot"].lng) : null;
        
        // 座標が有効でない場合はスキップ
        if (lat === null || lng === null) {
          console.warn(`parkingmeter-custommap: Spot ${index} has invalid coordinates`, spot);
          return;
        }

        const name = spot.name || spot.title || `Spot ${index + 1}`;

        // カスタムマーカーコンテンツの作成
        let markerContent = null;

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
        const marker = new google.maps.marker.AdvancedMarkerElement({
          map: parkingMeterMap,
          position: { lat, lng }, // positionは必ず指定
          content: markerContent,
          title: name,
        });

        // 画像や説明をinfoWindowで表示(既定の.gm-style-iw-d配下)
        const content = `
        <div class="gm-custom-popup">
          ${spot.photo ? `
            <div class="popup-image-wrap">
              <img src="${spot.photo}" alt="${name}">
            </div>` : ''}
          <div class="popup-body">
            <h3>${name}</h3>
            ${spot.desc ? `<p>${spot.desc}</p>` : ''}
          </div>
        </div>
        `;

        const infoWindow = new google.maps.InfoWindow({ 
        content: content,
        // 1. API側の最大幅制限を450pxまで広げる
        maxWidth: 450 
        });

        marker.addListener("click", () => {
          infoWindow.open({
            anchor: marker,
            map: parkingMeterMap,
          });
        });

        markers.push(marker);
      });

      // マーカークラスタリングを追加
      if (markers.length > 0) {
        new markerClusterer.MarkerClusterer({
          map: parkingMeterMap,
          markers,
        });
        console.log(`parkingmeter-custommap: ${markers.length} markers created`);
      } else {
        console.log('parkingmeter-custommap: No valid markers created');
      }
    } else {
      console.log(`parkingmeter-custommap: No mapSpots data found for map: ${mapData.containerId}`);
    }
  } catch (error) {
    console.error('parkingmeter-custommap: Error initializing map', error);
  }
}