<!-- パーキング情報の一覧マップ(ACF) -->
<?php
$parking_map = get_field('parking-map');
if ($parking_map): ?>
  <div class="parking-map-area">
    <img src="<?php echo esc_url($parking_map['url']); ?>" alt="<?php echo esc_attr($parking_map['alt']); ?>">
  </div>
<?php endif; ?>