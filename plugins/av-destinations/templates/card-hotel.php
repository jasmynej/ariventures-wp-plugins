<?php
/** @var array $h */
?>

<article class="hotel-card">
    <div class="card-hero" style="background-image: url('<?= esc_url($h['image_url']); ?>');">
        <div>
            <h2><?= esc_html($h['title'])?></h2>
        </div>
    </div>

</article>
