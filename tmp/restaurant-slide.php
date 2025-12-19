<!-- swiper(個別飲食店のスライダー) -->
<?php
$images = get_sub_field('restaurant-slider');
if ($images): ?>
  <div class="swiper restaurant-slider">
    <div class="swiper-wrapper restaurant-slider-wrapper">
      <?php foreach ($images as $image): ?>
        <div class="swiper-slide restaurant-slide">
          <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
        </div>
      <?php endforeach; ?>
    </div>
    <!-- ナビゲーションやページネーション -->
    <div class="swiper-pagination"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
  </div>
<?php endif; ?>