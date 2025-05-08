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
        <?php if(get_sub_field('hp')): //対象のサブフィールド(URL)が存在する場合に出力 ?>
        <p>【HP】<a href="<?php the_sub_field('hp'); ?>"><?php the_sub_field('hp'); ?></a></p>
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
  <?php endwhile; ?>
<?php endif; ?>