<!-- ACF「「スポット情報」を表示 -->
<?php
$selected_icons = get_field('spot-info');

if ($selected_icons):
  echo '<div class="spot-list">';
  foreach ($selected_icons as $icon) {
    $icon_url = get_stylesheet_directory_uri() . '/assets/img/' . $icon . '.png';
    echo '<img src="' . esc_url($icon_url) . '" alt="' . esc_attr($icon) . '" class="spot-icon">';
  }
  echo '</div>';
endif;
?>