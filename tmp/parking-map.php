<!-- パーキング情報の一覧マップ(ACF)
 ※なぜか上部のコード(~9行目)がないとACFで設定したマップが表示されない(DOMに.parking-map-areaが表示されていない)。応急処置的に上部は残したままで表示。ACFの読み込みタイミングに問題があるのか? -->
<?php
$parking_map = get_field('parking-map');
if ($parking_map): ?>
  <div class="parking-map-area">
    <a href="<?php echo esc_url($parking_map['url']); ?>">
      <img src="<?php echo esc_url($parking_map['url']); ?>" alt="<?php echo esc_attr($parking_map['alt']); ?>">
    </a>
  </div>
<?php endif; ?>

<?php
$parking_map = get_field('parking-map');
if ($parking_map): ?>
  <div class="parking-map-area">
    <a href="<?php echo esc_url($parking_map['url']); ?>">
      <img src="<?php echo esc_url($parking_map['url']); ?>" alt="<?php echo esc_attr($parking_map['alt']); ?>">
    </a>
  </div>
<?php endif; ?>
