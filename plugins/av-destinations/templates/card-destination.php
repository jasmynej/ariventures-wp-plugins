<?php
/** @var array $d */
$bg = !empty($d['image_url']) ? "background-image:url('".esc_url($d['image_url'])."')" : '';
?>
<a href="<?= esc_url($d['permalink']); ?>" class="card-hero" style="<?= $bg; ?>">
    <div class="overlay">
        <h2><?= esc_html($d['title']); ?></h2>
        <?php if (!empty($d['tagline'])): ?>
            <p><?= esc_html($d['tagline']); ?></p>
        <?php endif; ?>
    </div>
</a>