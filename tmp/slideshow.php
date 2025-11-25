<!-- swiper(個別投稿のまとめスライダー) -->
<?php
$images = get_field('top-gallery');
if ($images): ?>
  <div class="swiper top-gallery">
    <div class="swiper-wrapper top-gallery-wrapper">
      <?php foreach ($images as $image): ?>
        <div class="swiper-slide top-gallery-slide">
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