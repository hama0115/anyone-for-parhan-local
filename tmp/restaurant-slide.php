<!-- swiper(個別飲食店のスライダー) -->
<?php
$images = get_sub_field('restaurant-slider');
if ($images): ?>
  <div class="restaurant-slider">
    <div class="restaurant-slider-wrapper">
      <?php foreach ($images as $image): ?>
        <div class="restaurant-slider-slide">
          <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
        </div>
      <?php endforeach; ?>
    </div>
    <!-- ナビゲーションやページネーション -->
    <div class="restaurant-slider-pagination"></div>
    <div class="restaurant-slider-button-prev"></div>
    <div class="restaurant-slider-button-next"></div>
  </div>
<?php endif; ?>