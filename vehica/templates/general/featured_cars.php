<?php
/* @var \Vehica\Widgets\General\FeaturedCarsGeneralWidget $vehicaCurrentWidget */
global $vehicaCurrentWidget, $vehicaCarCard, $vehicaFeaturedCars;
$vehicaCarCard = $vehicaCurrentWidget->getCard();
$vehicaFeaturedCars = $vehicaCurrentWidget->getFeaturedCars();
?>
<div class="vehica-app">
    <vehica-car-tabs
            widget-id="<?php echo esc_attr($vehicaCurrentWidget->get_id()); ?>"
            :tabs="<?php echo htmlspecialchars(json_encode($vehicaCurrentWidget->getTabs())); ?>"
            :featured="<?php echo esc_attr($vehicaCurrentWidget->featured() ? 'true' : 'false'); ?>"
            :card-config="<?php echo htmlspecialchars(json_encode($vehicaCurrentWidget->getCardConfig())) ?>"
            request-url="<?php echo esc_url(admin_url('admin-ajax.php?action=vehica_featured_cars')); ?>"
            :limit="<?php echo esc_attr($vehicaCurrentWidget->getCarsNumber()); ?>"
            sort-by="<?php echo esc_attr($vehicaCurrentWidget->getSortBy()); ?>"
            sort-by-rewrite="<?php echo esc_attr(vehicaApp('sort_by_rewrite')); ?>"
            content-class="vehica-featured-v1__content"
    >
        <div slot-scope="carTabs" class="vehica-featured-v1 <?php echo esc_attr($vehicaCurrentWidget->getCarsNumber()); ?>">
            <div class="vehica-tabs-top-v1">
                <div class="vehica-tabs-top-v1__center">
                    <?php if ($vehicaCurrentWidget->hasFirstHeading()) : ?>
                        <h3 class="vehica-tabs-top-v1__heading-small">
                            <?php echo esc_html($vehicaCurrentWidget->getFirstHeading()); ?>
                        </h3>
                    <?php endif; ?>

                    <?php if ($vehicaCurrentWidget->hasSecondHeading()) : ?>
                        <h2 class="vehica-tabs-top-v1__heading-big">
                            <?php echo esc_html($vehicaCurrentWidget->getSecondHeading()); ?>
                        </h2>
                    <?php endif; ?>
                </div>

                <!-- <div class="vehica-tabs-top-v1__right">
                    <?php if ($vehicaCurrentWidget->hasTabs()) : ?>
                        <div v-dragscroll.pass="true" class="vehica-tabs-wrapper">
                            <div class="vehica-tabs">
                                <div class="vehica-tabs__inner">
                                    <?php foreach ($vehicaCurrentWidget->getTabs() as $vehicaTab) :
                                        /* @var \Vehica\Model\Term\Term $vehicaTab */ ?>
                                        <div
                                                class="vehica-tab"
                                                :class="{'vehica-tab--active': carTabs.isActive('<?php echo esc_attr($vehicaTab->getKey()); ?>')}"
                                                @click="carTabs.setTab('<?php echo esc_attr($vehicaTab->getKey()); ?>')"
                                        >
                                            <div class="vehica-tab__title">
                                                <?php echo esc_html($vehicaTab->getName()); ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>

                                    <div class="vehica-featured-v1__tab-ghost"></div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div> -->
            </div>

            <div class="vehica-featured-v1__content">
                <?php get_template_part('templates/shared/featured_cars'); ?>
            </div>

            <div class="vehica-featured-v1__footer">
                <?php if ($vehicaCurrentWidget->showSocials()) : ?>
                    <div class="vehica-featured-v1__social">
                        <div class="vehica-featured-v1__social__label">
                            <?php echo esc_html(vehicaApp('follow_us_string')); ?>
                        </div>
                        <div class="vehica-featured-v1__social-icons">
                            <?php if (!empty(vehicaApp('facebook_url'))) : ?>
                                <a
                                        href="<?php echo esc_url(vehicaApp('facebook_url')); ?>"
                                        target="_blank"
                                        class="vehica-featured-v1__social-icon"
                                >
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            <?php endif; ?>

                            <?php if (!empty(vehicaApp('twitter_url'))) : ?>
                                <a
                                        href="<?php echo esc_url(vehicaApp('twitter_url')); ?>"
                                        target="_blank"
                                        class="vehica-featured-v1__social-icon"
                                >
                                    <i class="fab fa-twitter"></i>
                                </a>
                            <?php endif; ?>

                            <?php if (!empty(vehicaApp('instagram_url'))) : ?>
                                <a
                                        href="<?php echo esc_url(vehicaApp('instagram_url')); ?>"
                                        target="_blank"
                                        class="vehica-featured-v1__social-icon"
                                >
                                    <i class="fab fa-instagram"></i>
                                </a>
                            <?php endif; ?>

                            <?php if (!empty(vehicaApp('youtube_url'))) : ?>
                                <a
                                        href="<?php echo esc_url(vehicaApp('youtube_url')); ?>"
                                        target="_blank"
                                        class="vehica-featured-v1__social-icon"
                                >
                                    <i class="fab fa-youtube"></i>
                                </a>
                            <?php endif; ?>

                            <?php if (!empty(vehicaApp('linkedin_url'))) : ?>
                                <a
                                        href="<?php echo esc_url(vehicaApp('linkedin_url')); ?>"
                                        target="_blank"
                                        class="vehica-featured-v1__social-icon"
                                >
                                    <i class="fab fa-linkedin"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($vehicaCurrentWidget->showElement('view_all_button')) : ?>
                    <div class="vehica-featured-v1__button">
                        <a class="vehica-button" :href="carTabs.viewAllUrl" :title="carTabs.viewAllTitle">
                            <?php echo esc_html(vehicaApp('view_string')); ?>
                            <template>{{ carTabs.viewAllCount }} {{ carTabs.viewAllTitle }}</template>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </vehica-car-tabs>
</div>