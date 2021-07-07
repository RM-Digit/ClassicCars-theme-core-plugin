<?php
/* @var \Vehica\Widgets\General\SocialProfilesGeneralWidget $vehicaCurrentWidget */
global $vehicaCurrentWidget;
?>
<div class="vehica-social-profiles">
    <?php if ($vehicaCurrentWidget->isStyleV1()) : ?>
        <div class="vehica-social-profiles__v1">
            <?php if (!empty(vehicaApp('facebook_url'))) : ?>
                <div class="vehica-social-icon">
                    <a
                            href="<?php echo esc_url(vehicaApp('facebook_url')); ?>"
                            title="<?php esc_attr_e('Facebook', 'vehica'); ?>"
                            target="_blank"
                    >
                        <i class="fab fa-facebook-f"></i>
                    </a>
                </div>
            <?php endif; ?>

            <?php if (!empty(vehicaApp('twitter_url'))) : ?>
                <div class="vehica-social-icon">
                    <a
                            href="<?php echo esc_url(vehicaApp('twitter_url')); ?>"
                            title="<?php esc_attr_e('Twitter', 'vehica'); ?>"
                            target="_blank"
                    >
                        <i class="fab fa-twitter"></i>
                    </a>
                </div>
            <?php endif; ?>

            <?php if (!empty(vehicaApp('instagram_url'))) : ?>
                <div class="vehica-social-icon">
                    <a
                            href="<?php echo esc_url(vehicaApp('instagram_url')); ?>"
                            title="<?php esc_attr_e('Instagram', 'vehica'); ?>"
                            target="_blank"
                    >
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            <?php endif; ?>

            <?php if (!empty(vehicaApp('youtube_url'))) : ?>
                <div class="vehica-social-icon">
                    <a
                            href="<?php echo esc_url(vehicaApp('youtube_url')); ?>"
                            title="<?php esc_attr_e('YouTube', 'vehica'); ?>"
                            target="_blank"
                    >
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            <?php endif; ?>

            <?php if (!empty(vehicaApp('linkedin_url'))) : ?>
                <div class="vehica-social-icon">
                    <a
                            href="<?php echo esc_url(vehicaApp('linkedin_url')); ?>"
                            title="<?php esc_attr_e('LinkedIn', 'vehica'); ?>"
                            target="_blank"
                    >
                        <i class="fab fa-linkedin"></i>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    <?php elseif ($vehicaCurrentWidget->isStyleV2()) : ?>
        <div class="vehica-social-profiles__v2">
            <div class="vehica-social-profiles__v2__inner">
                <div class="vehica-social-profiles__v2__title">
                    <?php echo esc_html(vehicaApp('follow_us_string')); ?>
                </div>
                <?php if (!empty(vehicaApp('facebook_url'))) : ?>
                    <div class="vehica-social-icon">
                        <a
                                href="<?php echo esc_url(vehicaApp('facebook_url')); ?>"
                                title="<?php esc_attr_e('Facebook', 'vehica'); ?>"
                                target="_blank"
                        >
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </div>
                <?php endif; ?>

                <?php if (!empty(vehicaApp('twitter_url'))) : ?>
                    <div class="vehica-social-icon">
                        <a
                                href="<?php echo esc_url(vehicaApp('twitter_url')); ?>"
                                title="<?php esc_attr_e('Twitter', 'vehica'); ?>"
                                target="_blank"
                        >
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                <?php endif; ?>

                <?php if (!empty(vehicaApp('instagram_url'))) : ?>
                    <div class="vehica-social-icon">
                        <a
                                href="<?php echo esc_url(vehicaApp('instagram_url')); ?>"
                                title="<?php esc_attr_e('Instagram', 'vehica'); ?>"
                                target="_blank"
                        >
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                <?php endif; ?>

                <?php if (!empty(vehicaApp('youtube_url'))) : ?>
                    <div class="vehica-social-icon">
                        <a
                                href="<?php echo esc_url(vehicaApp('youtube_url')); ?>"
                                title="<?php esc_attr_e('YouTube', 'vehica'); ?>"
                                target="_blank"
                        >
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                <?php endif; ?>

                <?php if (!empty(vehicaApp('linkedin_url'))) : ?>
                    <div class="vehica-social-icon">
                        <a
                                href="<?php echo esc_url(vehicaApp('linkedin_url')); ?>"
                                title="<?php esc_attr_e('LinkedIn', 'vehica'); ?>"
                                target="_blank"
                        >
                            <i class="fab fa-linkedin"></i>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</div>