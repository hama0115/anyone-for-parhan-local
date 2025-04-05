<!-- ACF「パーキングメーター情報」を表示 -->
<?php if(have_rows('meter-info')): ?>
  <?php while(have_rows('meter-info')): the_row(); ?>
    <div class="parking-info-container">
      <?php //対象のサブフィールド(画像)が存在する場合に出力(パーキングメーターの位置を示すイラスト)
      $image = get_sub_field('parkingmeter-position');
      if(!empty($image)):
      ?>
      <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
      <?php endif; ?>
      <?php //対象のサブフィールド(画像)が存在する場合に出力(パーキングメーターの写真)
      $image = get_sub_field('parkingmeter-photo');
      if(!empty($image)):
      ?>
      <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
      <?php endif; ?>
      <div class="parking-text-container">
        <?php if(get_sub_field('time')): //対象のサブフィールド(テキスト)が存在する場合に出力 ?>
          <p>【時間】<?php the_sub_field('time'); ?></p>
        <?php endif; ?>
        <?php if(get_sub_field('system')): ?>
          <p>【方式】<?php the_sub_field('system'); ?></p>
        <?php endif; ?>
        <?php if(get_sub_field('the-number-of-field')): ?>
          <p>【枠数】<?php the_sub_field('the-number-of-field'); ?></p>
      </div>
    </div>
    <?php endif; ?>
  <?php endwhile; ?>
<?php endif; ?>