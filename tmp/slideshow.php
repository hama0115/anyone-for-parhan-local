<!-- swiper -->
<?php
          $images = get_field('slider-gallery');
          if ($images): ?>
            <div class="swiper">
              <div class="swiper-wrapper">
                <?php foreach ($images as $image): ?>
                  <div class="swiper-slide">
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