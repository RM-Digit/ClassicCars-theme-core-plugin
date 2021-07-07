<?php
/* @var \Vehica\Widgets\User\SocialUserWidget $vehicaCurrentWidget */
/* @var \Vehica\Model\User\User $vehicaUser */
global $vehicaCurrentWidget, $vehicaUser;

if ( ! $vehicaUser || ! $vehicaCurrentWidget) {
    return;
}
?>
<div class="vehica-social-icons-wrapper vehica-social-icons-wrapper--profile">
    <?php if ($vehicaUser->hasFacebookProfile()) : ?>
        <div class="vehica-social-icon">
            <a
                    href="<?php echo esc_url($vehicaUser->getFacebookProfile()); ?>"
                    title="<?php esc_attr_e('Facebook', 'vehica'); ?>"
                    target="_blank"
            >
                <i class="fab fa-facebook-f"></i>
            </a>
        </div>
    <?php endif; ?>

    <?php if ($vehicaUser->hasInstagramProfile()) : ?>
        <div class="vehica-social-icon">
            <a
                    href="<?php echo esc_url($vehicaUser->getInstagramProfile()); ?>"
                    title="<?php esc_attr_e('Instagram', 'vehica'); ?>"
                    target="_blank"
            >
                <i class="fab fa-instagram"></i>
            </a>
        </div>
    <?php endif; ?>

    <?php if ($vehicaUser->hasLinkedinProfile()) : ?>
        <div class="vehica-social-icon">
            <a
                    href="<?php echo esc_url($vehicaUser->getLinkedinProfile()); ?>"
                    title="<?php esc_attr_e('LinkedIn', 'vehica'); ?>"
                    target="_blank"
            >
                <i class="fab fa-linkedin"></i>
            </a>
        </div>
    <?php endif; ?>

    <?php if ($vehicaUser->hasTwitterProfile()) : ?>
        <div class="vehica-social-icon">
            <a
                    href="<?php echo esc_url($vehicaUser->getTwitterProfile()); ?>"
                    title="<?php esc_attr_e('Twitter', 'vehica'); ?>"
                    target="_blank"
            >
                <i class="fab fa-twitter"></i>
            </a>
        </div>
    <?php endif; ?>
</div>