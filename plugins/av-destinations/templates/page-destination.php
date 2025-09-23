<?php
/** @var array $d */
?>

<div class="page-container">
    <div class="hero" style="background-image: url('<?= esc_url($d['image_url']); ?>');">
        <div class="overlay">
            <h1 class="title">Discover <?= esc_html($d['title'])?></h1>
            <div>
                <button id="view-trip">View All Trips</button>
                <button id="create-trip">Create a Custom Itinerary</button>
            </div>
        </div>
    </div>
    <div class="info">
        <div class="why-visit">
            <h2>Why Visit <?= esc_html($d['title'])?>?</h2>
            <p><?= esc_html($d['excerpt'])?></p>
        </div>
        <div class="quick-facts">
            <h3>Quick Facts</h3>
            <p><?= $d['quick_facts']['capital']?></p>
        </div>
    </div>
</div>
