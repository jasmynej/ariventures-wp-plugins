<?php
/** @var array $d */
?>

<div class="container">
    <div class="hero" style="background-image: url('<?= esc_url($d['image_url']); ?>');">
        <div class="overlay">
            <h1 class="title">Discover <?= esc_html($d['title'])?></h1>
            <h2>with ariventures</h2>
        </div>
    </div>
    <div>
        <p><?= esc_html($d['excerpt'])?></p>
    </div>
    <div>
        <h2>Where to Stay</h2>
        <div>
            <?php foreach (($d['hotels'] ?? []) as $hotel): ?>
                <?= av_render_template('card-hotel.php', ['h' => $hotel]); ?>
            <?php endforeach;?>
        </div>
    </div>
</div>
