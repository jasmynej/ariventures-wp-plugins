<?php
$name = isset($atts['name']) ? esc_html($atts['name']) : 'Traveler';
?>

<div class="ariv-card">
    <h3 class="ariv-card__title">Hello, <?php echo $name; ?>! Ariventures Plugin test</h3>
</div>
