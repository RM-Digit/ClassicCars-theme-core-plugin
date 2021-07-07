<?php
/* @var \Vehica\Widgets\Car\Single\BigFeaturesSingleCarWidget $vehicaCurrentWidget */
global $vehicaCurrentWidget, $vehicaCar;

if (!$vehicaCar) {
    return;
}

$vehicaFeatures = $vehicaCurrentWidget->getFeatures($vehicaCar);
if ($vehicaFeatures->isEmpty()) {
    return;
}
?>
<div class="vehica-car-features-pills">
    <?php foreach ($vehicaFeatures as $vehicaFeature) : ?>
        <div class="vehica-car-features-pills__single">
            <?php if ($vehicaCurrentWidget->showElement('icon')) : ?>
                <i class="far fa-check-circle"></i>
            <?php endif; ?>
            
            <span><?php echo esc_html($vehicaFeature); ?></span>
        </div>
    <?php endforeach; ?>
</div>