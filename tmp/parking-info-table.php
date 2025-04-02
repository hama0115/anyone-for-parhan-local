<!-- ACF「パーキングメーター情報」を表示 -->
<?php if(have_rows('meter-info')): ?>
  <?php while(have_rows('meter-info')): the_row(); ?>
    <div class="parking-info-container">
      <?php //対象のサブフィールド(画像)が存在する場合に出力
      $image = get_sub_field('parkingmeter-photo');
      if(!empty($image)):
      ?>
      <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
      <?php endif; ?>
      <div class="parking-text-container">
        <?php if(get_sub_field('time')): //対象のサブフィールド(テキスト)が存在する場合に出力 ?>
        <dl>
          <dt>【時間】</dt>
          <dd><?php the_sub_field('time'); ?></dd>
        </dl>
        <?php endif; ?>
        <?php if(get_sub_field('system')): ?>
        <dl>
          <dt>【方式】</dt>
          <dd><?php the_sub_field('system'); ?></dd>
        </dl>
        <?php endif; ?>
        <?php if(get_sub_field('the-number-of-field')): ?>
        <dl>
          <dt>【枠数】</dt>
          <dd><?php the_sub_field('the-number-of-field'); ?></dd>
        </dl>
      </div>
    </div>
    <?php endif; ?>
  <?php endwhile; ?>
<?php endif; ?>