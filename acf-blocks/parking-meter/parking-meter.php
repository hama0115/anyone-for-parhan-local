<!-- ACF「パーキング情報」ブロック -->
<?php      
$map_id = 'map_' . $block['id']; //ブロックごとのidを付与
$center = get_field('pm-googlemap-center'); // 「PMごとのgooglemapマーカーの中心地点」からデータ取得
$markers = get_field('pm-googlemap-markers'); //「PMごとのgooglemapマーカー地図」からデータ取得
?>

<!-- 「パーキングメーター情報」フィールド -->
<?php if(have_rows('meter-info')): ?>
  <?php while(have_rows('meter-info')): the_row(); ?>
    <div class="parking-info-container">    
      
      <?php //対象のサブフィールド(画像)が存在する場合に出力(パーキングメーターの写真)
      $image = get_sub_field('parkingmeter-photo');
      if(!empty($image)):
      ?>
      <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
      <?php endif; ?>
      
      <div class="detail-container">
        <div class="parking-text-container">
          <?php if(get_sub_field('time')): //対象のサブフィールド(テキスト)が存在する場合に出力 ?>
            <p>【時間】<?php the_sub_field('time'); ?></p>
          <?php endif; ?>
          <?php if(get_sub_field('system')): ?>
            <p>【方式】<?php the_sub_field('system'); ?></p>
          <?php endif; ?>
          <?php if(get_sub_field('the-number-of-field')): ?>
            <p>【枠数】<?php the_sub_field('the-number-of-field'); ?></p>
          <?php endif; ?>
        </div>
        <?php //道路標識のアイコンを表示
        $selected_icons = get_sub_field('traffic-sign-area');
        if ($selected_icons):
          echo '<div class="traffic-sign-list">';
          foreach ($selected_icons as $icon) {
            $icon_url = get_stylesheet_directory_uri() . '/assets/img/traffic-sign/' . $icon . '.png';
            
            //ツールチップ用のタイトルを用意
            $spot_title_map = [
              'not-cross' => '横断禁止',
              'not-parking' => '駐停車禁止',
              'not-parking-07300930' => '駐停車禁止(07:30~09:30)',
              'parking-with-limit' => '時間制限駐車区間(09:30~19)',
            ];
            $spot_title = isset($spot_title_map[$icon]) ? $spot_title_map[$icon] : $icon;

            echo '<img src="' . esc_url($icon_url) . '" alt="' . esc_attr($icon) . '" title="'.esc_attr($spot_title) .'" class="traffic-sign">';
          }
          echo '</div>';
        endif;
        ?>
      </div>

      <!-- 概要文、周辺の飲食店リストをまとめたエリア -->
      <div class="desc-area">

        <!-- 概要文 -->
        <?php if(get_sub_field('description')): //対象のサブフィールド(テキスト)が存在する場合に出力 ?>
          <p><?php the_sub_field('description'); ?></p>
        <?php endif; ?>
        
        <!-- 周辺の飲食店リスト -->
        <?php if( have_rows('restaurant-around') ): ?>
          <div class="restaurant-container">
            <?php while ( have_rows('restaurant-around')): the_row();
              $illusts = get_sub_field('restaurant-illust');
              $name = get_sub_field('restaurant-name');
            ?>
              <div class="restaurant-item">
                <?php if ($illusts): ?>
                  <?php foreach( $illusts as $illust ): ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/restaurant-icon/<?php echo esc_attr($illust); ?>.png" alt="<?php echo esc_attr($illust); ?>">
                  <?php endforeach; ?>
                <?php endif; ?>

                <?php if (is_array($name) && !empty($name['url']) && !empty($name['title'])): ?>
                  <a href="<?php echo esc_url($name['url']); ?>">
                    <p><?php echo esc_html($name['title']); ?></p>
                  </a>
                <?php endif; ?>
              </div>
            <?php endwhile; ?>
          </div>
        <?php endif; ?>
      </div>

      <!-- ブロック固有のgooglemapマーカー地図 -->
      <?php if ($center && $markers): ?>
      <div id="<?php echo esc_attr($map_id); ?>" style="width:100%;height:400px"></div>

      <script>
        //マップ固有のデータをオブジェクトとして定義
        const mapData_<?php echo esc_js($map_id); ?> = {
          containerId: "<?php echo esc_js($map_id) ?>",
          center: <?php echo json_encode($center, JSON_UNESCAPED_UNICODE); ?>,
          spots: <?php echo json_encode($markers, JSON_UNESCAPED_UNICODE); ?>
        };

        // 関数が呼べるまで待つ(ここ重要!)
        function tryInitParkingMeterMap_<?php echo esc_js($map_id); ?>() {

          //ブロックごとのidをcontainerへ
          const container = document.getElementById("<?php echo esc_js($map_id); ?>");
          //mapsapiの読み込みを確認
          const apiReady = typeof google !== 'undefined' && google.maps && google.maps.Map;
          const funcReady = typeof initParkingMeterMap === 'function';

          if (container && apiReady && funcReady) {
            //parkingmeter-custommap.jsで定義された関数。ここで呼び出している
            initParkingMeterMap(mapData_<?php echo esc_js($map_id); ?>);
          } else {
            setTimeout(tryInitParkingMeterMap_<?php echo esc_js($map_id); ?>, 100);
          }
        }

        // DOMContentLoadedまたは即座に実行
        if (document.readyState === 'loading') {
          document.addEventListener('DOMContentLoaded', tryInitParkingMeterMap_<?php echo esc_js($map_id); ?>);
        } else {
          tryInitParkingMeterMap_<?php echo esc_js($map_id); ?>();
        }
      </script>
      <?php endif; ?>
    </div>
  <?php endwhile; ?>
<?php endif; ?>