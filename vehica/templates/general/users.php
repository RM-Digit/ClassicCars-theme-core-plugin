<?php /** @noinspection NotOptimalIfConditionsInspection */
/* @var \Vehica\Widgets\General\UsersGeneralWidget $vehicaCurrentWidget */
global $vehicaCurrentWidget;

$vehicaUsers = apply_filters('vehica/widget/users_v1/users', $vehicaCurrentWidget->getUsers());
?>
<div class="vehica-app vehica-users-section vehica-users-section--count-<?php echo esc_attr($vehicaUsers->count()); ?> vehica-<?php echo esc_attr($vehicaCurrentWidget->get_id_int()); ?>">
    <vehica-swiper
            :config="<?php echo htmlspecialchars(json_encode($vehicaCurrentWidget->getSwiperConfig())) ?>"
            :disable-groups="true"
            :breakpoints="<?php echo htmlspecialchars(json_encode($vehicaCurrentWidget->getBreakpoints())) ?>"
    >
        <div slot-scope="swiperProps">
            <div class="vehica-users-section__inner">
                <div class="vehica-users-section__left">
                    <div class="vehica-users-section__left__inner">
                        <h2 class="vehica-users-section__heading">
                            <?php echo esc_html($vehicaCurrentWidget->getHeading()); ?>
                        </h2>

                        <?php if ($vehicaCurrentWidget->hasText()) : ?>
                            <div>
                                <?php echo wp_kses_post($vehicaCurrentWidget->getText()); ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($vehicaCurrentWidget->showButton()) : ?>
                            <div class="vehica-users-section__button">
                                <a
                                        href="<?php echo esc_url($vehicaCurrentWidget->getButtonUrl()); ?>"
                                        title="<?php echo esc_attr($vehicaCurrentWidget->getButtonLabel()); ?>"
                                        class="vehica-button"
                                >
                                    <?php echo esc_html($vehicaCurrentWidget->getButtonLabel()); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <div class="clearfix"></div>

                        <div class="vehica-users-section__arrows-desktop">
                            <button
                                    @click="swiperProps.prevSlide"
                                    class="vehica-carousel__arrow vehica-carousel__arrow--left"
                            ></button>

                            <button
                                    @click="swiperProps.nextSlide"
                                    class="vehica-carousel__arrow vehica-carousel__arrow--right"
                            ></button>
                        </div>
                    </div>
                </div>

                <div class="vehica-users-section__right">
                    <div>
                        <div class="vehica-swiper-container vehica-swiper-container-horizontal">
                            <div class="vehica-swiper-wrapper">
                                <?php foreach ($vehicaUsers as $vehicaUser) : /* @var \Vehica\Model\User\User $vehicaUser */
                                    $vehicaShowPhone = $vehicaCurrentWidget->showPhone($vehicaUser);
                                    ?>
                                    <div class="vehica-swiper-slide">
                                        <div class="vehica-user-card-wrapper">
                                            <div class="vehica-user-card">
                                                <div class="vehica-user-card__image">
                                                    <a href="<?php echo esc_url($vehicaUser->getUrl()) ?>">
                                                        <?php if ($vehicaUser->hasImageUrl('vehica_672_568')) : ?>
                                                            <img
                                                                    src="<?php echo esc_url($vehicaUser->getImageUrl('vehica_672_568')); ?>"
                                                                    alt="<?php echo esc_attr($vehicaUser->getName()); ?>"
                                                            >
                                                        <?php endif; ?>
                                                    </a>
                                                </div>

                                                <?php if ($vehicaCurrentWidget->showElement('email_icon') || $vehicaShowPhone) : ?>
                                                    <div class="vehica-user-card__icons">
                                                        <?php if ($vehicaCurrentWidget->showElement('phone_icon') && $vehicaShowPhone) : ?>
                                                            <a href="tel:<?php echo esc_attr($vehicaUser->getPhoneUrl()); ?>"
                                                               class="vehica-user-card__icon vehica-user-card__icon--phone vehica-bg-primary">
                                                                <i class="fas fa-phone-alt"></i>
                                                            </a>
                                                        <?php endif ?>

                                                        <?php if ($vehicaCurrentWidget->showElement('email_icon')) : ?>
                                                            <a href="mailto:<?php echo esc_attr($vehicaUser->getMail()); ?>"
                                                               class="vehica-user-card__icon vehica-user-card__icon--email vehica-bg-primary">
                                                                <i class="fas fa-envelope"></i>
                                                            </a>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endif; ?>

                                                <div class="vehica-user-card__content">

                                                    <div class="vehica-user-card__heading">
                                                        <a
                                                                href="<?php echo esc_url($vehicaUser->getUrl()) ?>"
                                                                title="<?php echo esc_attr($vehicaUser->getName()) ?>"
                                                        >
                                                            <?php echo esc_html($vehicaUser->getName()) ?>
                                                        </a>
                                                    </div>

                                                    <?php if ($vehicaUser->hasJobTitle()) : ?>
                                                        <div class="vehica-user-card__subheading">
                                                            <?php echo esc_html($vehicaUser->getJobTitle()); ?>
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if ($vehicaCurrentWidget->showSocialIcons()) : ?>
                                                        <div class="vehica-user-card__social-icons">
                                                            <?php if ($vehicaUser->hasFacebookProfile()) : ?>
                                                                <div class="vehica-user-card__social-icon">
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
                                                                <div class="vehica-user-card__social-icon">
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
                                                                <div class="vehica-user-card__social-icon">
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
                                                                <div class="vehica-user-card__social-icon">
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

                                                    <?php if ($vehicaCurrentWidget->showElement('email') || ($vehicaCurrentWidget->showElement('phone') && $vehicaUser->hasPhone())) : ?>
                                                        <div class="vehica-user-card__separator"></div>
                                                    <?php endif; ?>

                                                    <?php if ($vehicaCurrentWidget->showElement('email')) : ?>
                                                        <div class="vehica-user-card__email">
                                                            <a
                                                                    href="mailto:<?php echo esc_attr($vehicaUser->getMail()); ?>"
                                                                    title="<?php echo esc_attr($vehicaUser->getMail()); ?>"
                                                            >
                                                                <?php echo esc_html($vehicaUser->getMail()); ?>
                                                            </a>
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if ($vehicaCurrentWidget->showElement('phone') && $vehicaUser->hasPhone()) : ?>
                                                        <div class="vehica-user-card__phone">
                                                            <a
                                                                    href="tel:<?php echo esc_attr($vehicaUser->getPhoneUrl()); ?>"
                                                                    title="<?php echo esc_attr($vehicaUser->getPhone()) ?>"
                                                            >
                                                                <?php echo esc_html($vehicaUser->getPhone()) ?>
                                                            </a>
                                                        </div>
                                                    <?php endif ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="vehica-users-section__arrows-mobile">
                                <button
                                        @click="swiperProps.prevSlide"
                                        class="vehica-carousel__arrow vehica-carousel__arrow--left"
                                ></button>

                                <button
                                        @click="swiperProps.nextSlide"
                                        class="vehica-carousel__arrow vehica-carousel__arrow--right"
                                ></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </vehica-swiper>
</div>