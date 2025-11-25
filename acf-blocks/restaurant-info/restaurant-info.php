<!-- ACF「飲食店情報」を表示 -->
<?php if(have_rows('restaurant-info')): ?>
  <?php while(have_rows('restaurant-info')): the_row(); ?>
    <div class="restaurant-block">
      <div class="restaurant-info-container">
        <!-- 飲食店関連の画像のスライドショー -->
        <?php get_template_part( 'tmp/restaurant-slide' ) ?>  
                      
        <?php //対象のサブフィールド(googleマップ)が存在する場合に出力
        $location = get_sub_field('area-map');
        if( $location ): ?>
          <div class="acf-map" data-zoom="16">
            <div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
          </div>
        <?php endif; ?>
        <div class="restaurant-text-container">
          <?php //対象のサブフィールド(リンク)が存在する場合に出力
          $hp = get_sub_field('hp');
          if (is_array($hp) && !empty($hp['url']) && !empty($hp['title'])):
            // 三項演算子でtargetが空の場合は_selfを設定
          $target = !empty($hp['target']) ? $hp['target'] : '_self';
          ?>
            <a href="<?php echo esc_url($hp['url']); ?>" target="<?php echo esc_attr($target) ?>">
              <p>【HP】<?php echo esc_html($hp['title']); ?></p>
            </a>
          <?php endif; ?>
          <?php if(get_sub_field('takeout')): //対象のサブフィールド(テキスト)が存在する場合に出力 ?>
          <p>【テイクアウト】<?php the_sub_field('takeout'); ?></p>
          <?php endif; ?>
          <?php if(get_sub_field('order')): ?>
            <p>【予約】<?php the_sub_field('order'); ?></p>
          <?php endif; ?>
          <?php if(get_sub_field('opening-hours')): ?>
            <p>【営業時間】<?php the_sub_field('opening-hours'); ?></p>
          <?php endif; ?>
        </div>
      </div>
      <div class="restaurant-desc">
        <?php if(get_sub_field('desc')): //対象のサブフィールド(テキスト)が存在する場合に出力 ?>
          <dl>
            <dt>【飲食店の概要】</dt>
            <dd><?php the_sub_field('desc'); ?></dd>
          </dl>
        <?php endif; ?>
      </div>
    </div>
  <?php endwhile; ?>
<?php endif; ?>