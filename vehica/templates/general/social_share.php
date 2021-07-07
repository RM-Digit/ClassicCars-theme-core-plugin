<?php
/* @var \Vehica\Widgets\General\SocialShareGeneralWidget $vehicaCurrentWidget */
global $vehicaCurrentWidget;
?>
<div class="vehica-social-share">
    <?php if ($vehicaCurrentWidget->showFacebook()) : ?>
        <a
                class="vehica-social-share__icon vehica-social-share__icon--facebook"
                href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url($vehicaCurrentWidget->getCurrentUrl()); ?>"
                target="_blank"
        >
            <i class="fab fa-facebook-f"></i> <?php esc_html_e('Share', 'vehica'); ?>
        </a>
    <?php endif; ?>

    <?php if ($vehicaCurrentWidget->showTwitter()) : ?>
        <a
                class="vehica-social-share__icon vehica-social-share__icon--twitter"
                href="https://twitter.com/share?url=<?php echo esc_url($vehicaCurrentWidget->getCurrentUrl()); ?>"
                target="_blank"
        >
            <i class="fab fa-twitter"></i> <?php esc_html_e('Tweet', 'vehica'); ?>
        </a>
    <?php endif; ?>
</div>
