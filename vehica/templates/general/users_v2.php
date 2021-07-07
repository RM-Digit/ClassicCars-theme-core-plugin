<?php
/* @var \Vehica\Widgets\General\UsersV2GeneralWidget $vehicaCurrentWidget */
global $vehicaCurrentWidget;

$vehicaImageSize = $vehicaCurrentWidget->getImageSize();
?>
<div class="vehica-users-v2">
    <?php if ($vehicaCurrentWidget->hasText()) : ?>
        <div class="vehica-user-card-v2 vehica-user-card-v2--text-editor">
            <div class="vehica-user-card-v2__text-editor">
                <?php echo wp_kses_post($vehicaCurrentWidget->getText()); ?>
            </div>
        </div>
    <?php endif; ?>

    <?php foreach ($vehicaCurrentWidget->getUsers() as $vehicaUser) :
        /* @var \Vehica\Model\User\User $vehicaUser */
        $vehicaShowPhone = $vehicaCurrentWidget->showPhone($vehicaUser);
        ?>
        <div class="vehica-user-card-v2">
            <a
                    class="vehica-user-card-v2__image"
                    href="<?php echo esc_url($vehicaUser->getUrl()); ?>"
                    title="<?php echo esc_attr($vehicaUser->getName()); ?>"
            >
                <?php if ($vehicaUser->hasImageUrl('vehica_672_568')) : ?>
                    <img
                            src="<?php echo esc_url($vehicaUser->getImageUrl('vehica_672_568')); ?>"
                            alt="<?php echo esc_attr($vehicaUser->getName()); ?>"
                    >
                <?php endif; ?>
            </a>

            <div class="vehica-user-card-v2__content">
                <div class="vehica-user-card__icons">
                    <?php if ($vehicaShowPhone) : ?>
                        <a
                                href="tel:<?php echo esc_attr($vehicaUser->getPhoneUrl()); ?>"
                                class="vehica-user-card__icon vehica-user-card__icon--phone vehica-bg-primary"
                        >
                            <i class="fas fa-phone-alt"></i>
                        </a>
                    <?php endif ?>

                    <a href="mailto:<?php echo esc_attr($vehicaUser->getMail()); ?>"
                       class="vehica-user-card__icon vehica-user-card__icon--email vehica-bg-primary">
                        <i class="fas fa-envelope"></i>
                    </a>
                </div>

                <a
                        class="vehica-user-card-v2__name"
                        href="<?php echo esc_url($vehicaUser->getUrl()); ?>"
                        title="<?php echo esc_attr($vehicaUser->getName()); ?>"
                >
                    <?php echo esc_html($vehicaUser->getName()); ?>
                </a>

                <?php if ($vehicaUser->hasJobTitle()) : ?>
                    <div class="vehica-user-card-v2__job-title">
                        <?php echo esc_html($vehicaUser->getJobTitle()); ?>
                    </div>
                <?php endif; ?>

                <?php if ($vehicaCurrentWidget->showSocialIcons()) : ?>
                    <div class="vehica-user-card-v2__social-icons">
                        <?php if ($vehicaUser->hasFacebookProfile()) : ?>
                            <div class="vehica-user-card-v2__social-icon">
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
                            <div class="vehica-user-card-v2__social-icon">
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
                            <div class="vehica-user-card-v2__social-icon">
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
                            <div class="vehica-user-card-v2__social-icon">
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
                <?php endif; ?>

                <?php if ($vehicaShowPhone) : ?>
                    <a
                            href="tel:<?php echo esc_attr($vehicaUser->getPhoneUrl()); ?>"
                            class="vehica-user-card-v2__phone"
                    >
                        <i class="fa fa-phone-alt"></i>
                        <?php echo esc_html($vehicaUser->getPhone()); ?>
                    </a>
                <?php endif; ?>

                <a
                        class="vehica-user-card-v2__email"
                        href="mailto:<?php echo esc_attr($vehicaUser->getMail()); ?>"
                >
                    <i class="fa fa-envelope"></i>
                    <?php echo esc_html($vehicaUser->getMail()); ?>
                </a>

            </div>
        </div>
    <?php endforeach; ?>
</div>
