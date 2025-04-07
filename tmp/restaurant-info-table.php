<!-- ACF「飲食店情報」を表示 -->
<?php if(have_rows('restaurant-info')): ?>
  <?php while(have_rows('restaurant-info')): the_row(); ?>
    <div class="restaurant-info-container">
      <?php //対象のサブフィールド(画像)が存在する場合に出力
      $image = get_sub_field('restaurant-photo');
      if(!empty($image)):
      ?>
      <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
      <?php endif; ?>
      <?php //対象のサブフィールド(画像)が存在する場合に出力
      $image = get_sub_field('menu-photo');
      if(!empty($image)):
      ?>
      <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
      <?php endif; ?>
      <?php //対象のサブフィールド(googleマップ)が存在する場合に出力
      $location = get_sub_field('area-map');
      if( $location ): ?>
        <div class="acf-map" data-zoom="16">
          <div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
        </div>
      <?php endif; ?>
      <div class="restaurant-text-container">
        <?php if(get_sub_field('time-to-eat')): //対象のサブフィールド(テキスト)が存在する場合に出力 ?>
        <dl>
          <dt>【食事の目安時間】</dt>
          <dd><?php the_sub_field('time-to-eat'); ?></dd>
        </dl>
        <?php endif; ?>
        <?php if(get_sub_field('parking-meter')): ?>
        <dl>
          <dt>【Pメーター】</dt>
          <dd><?php the_sub_field('parking-meter'); ?></dd>
        </dl>
        <?php endif; ?>
        <?php if(get_sub_field('takeout')): ?>
        <dl>
          <dt>【テイクアウト】</dt>
          <dd><?php the_sub_field('takeout'); ?></dd>
        </dl>
        <?php endif; ?>
        <?php if(get_sub_field('order')): ?>
        <dl>
          <dt>【予約】</dt>
          <dd><?php the_sub_field('order'); ?></dd>
        </dl>
        <?php endif; ?>
        <?php if(get_sub_field('opening-hours')): ?>
        <dl>
          <dt>【営業時間】</dt>
          <dd><?php the_sub_field('opening-hours'); ?></dd>
        </dl>
        <?php endif; ?>
      </div>
    </div>
  <?php endwhile; ?>
<?php endif; ?>