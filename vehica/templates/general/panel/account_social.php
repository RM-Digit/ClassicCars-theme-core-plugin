<?php
/* @var \Vehica\Widgets\General\PanelGeneralWidget $vehicaCurrentWidget */

global $vehicaCurrentWidget;
$vehicaUser = vehicaApp('current_user');
if ( ! $vehicaUser instanceof \Vehica\Model\User\User) {
    return;
}
?>
<div class="vehica-container">
    <?php get_template_part('templates/general/panel/account_menu'); ?>

    <vehica-panel-change-social
            request-url="<?php echo esc_url(admin_url('admin-post.php?action=vehica_save_account_social')); ?>"
            vehica-nonce="<?php echo esc_attr(wp_create_nonce('vehica_save_account_social')); ?>"
            in-progress-string="<?php echo esc_attr(vehicaApp('in_progress_string')); ?>"
            success-string="<?php echo esc_attr(vehicaApp('success_string')); ?>"
            error-string="<?php echo esc_attr(vehicaApp('error_string')); ?>"
            initial-facebook="<?php echo esc_attr($vehicaUser->getFacebookProfile()); ?>"
            initial-instagram="<?php echo esc_attr($vehicaUser->getInstagramProfile()); ?>"
            initial-twitter="<?php echo esc_attr($vehicaUser->getTwitterProfile()); ?>"
            initial-linkedin="<?php echo esc_attr($vehicaUser->getLinkedinProfile()); ?>"
    >
        <div slot-scope="props">
            <div class="vehica-panel-account">
                <div class="vehica-panel-account__inner">
                    <h3 class="vehica-panel-account__title">
                        <?php echo esc_html(vehicaApp('change_social_string')); ?>
                    </h3>

                    <div class="vehica-panel-account__social">
                        <form @submit.prevent="props.onChange">
                            <div class="vehica-grid">
                                <div class="vehica-grid__element--mobile-1of1 vehica-grid__element--tablet-1of1 vehica-grid__element--1of3">
                                    <div class="vehica-panel-account-field">
                                        <label
                                                for="<?php echo esc_attr(\Vehica\Model\User\User::FACEBOOK_PROFILE); ?>"
                                                class="vehica-panel-account-field__label"
                                        >
                                            <?php esc_html_e('Facebook', 'vehica'); ?>
                                        </label>

                                        <div class="vehica-panel-account-field__facebook">
                                            <input
                                                    id="<?php echo esc_attr(\Vehica\Model\User\User::FACEBOOK_PROFILE); ?>"
                                                    class="vehica-panel-account-field__text-control vehica-panel-account-field__text-control--social"
                                                    type="text"
                                                    @input="props.setFacebook($event.target.value)"
                                                    :value="props.facebook"
                                            >
                                        </div>
                                    </div>
                                </div>
                                <div class="vehica-grid__element--mobile-1of1 vehica-grid__element--tablet-1of1 vehica-grid__element--1of3">
                                    <div class="vehica-panel-account-field">
                                        <label
                                                for="<?php echo esc_attr(\Vehica\Model\User\User::INSTAGRAM_PROFILE); ?>"
                                                class="vehica-panel-account-field__label"
                                        >
                                            <?php esc_html_e('Instagram', 'vehica'); ?>
                                        </label>

                                        <div class="vehica-panel-account-field__instagram">
                                            <input
                                                    id="<?php echo esc_attr(\Vehica\Model\User\User::INSTAGRAM_PROFILE); ?>"
                                                    class="vehica-panel-account-field__text-control vehica-panel-account-field__text-control--social"
                                                    type="text"
                                                    @input="props.setInstagram($event.target.value)"
                                                    :value="props.instagram"
                                            >
                                        </div>
                                    </div>
                                </div>
                                <div class="vehica-grid__element--mobile-1of1 vehica-grid__element--tablet-1of1 vehica-grid__element--1of3">
                                    <div class="vehica-panel-account-field">
                                        <label
                                                for="<?php echo esc_attr(\Vehica\Model\User\User::TWITTER_PROFILE); ?>"
                                                class="vehica-panel-account-field__label"
                                        >
                                            <?php esc_html_e('Twitter', 'vehica'); ?>
                                        </label>

                                        <div class="vehica-panel-account-field__twitter">
                                            <input
                                                    id="<?php echo esc_attr(\Vehica\Model\User\User::TWITTER_PROFILE); ?>"
                                                    class="vehica-panel-account-field__text-control vehica-panel-account-field__text-control--social"
                                                    type="text"
                                                    @input="props.setTwitter($event.target.value)"
                                                    :value="props.twitter"
                                            >
                                        </div>
                                    </div>
                                </div>
                                <div class="vehica-grid__element--mobile-1of1 vehica-grid__element--tablet-1of1 vehica-grid__element--1of3">
                                    <div class="vehica-panel-account-field">
                                        <label
                                                for="<?php echo esc_attr(\Vehica\Model\User\User::LINKEDIN_PROFILE); ?>"
                                                class="vehica-panel-account-field__label"
                                        >
                                            <?php esc_html_e('LinkedIn', 'vehica'); ?>
                                        </label>

                                        <div class="vehica-panel-account-field__linkedin">
                                            <input
                                                    id="<?php echo esc_attr(\Vehica\Model\User\User::LINKEDIN_PROFILE); ?>"
                                                    class="vehica-panel-account-field__text-control vehica-panel-account-field__text-control--social"
                                                    type="text"
                                                    @input="props.setLinkedin($event.target.value)"
                                                    :value="props.linkedin"
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="vehica-panel-account__button-save">
                                <button
                                        class="vehica-button vehica-button--with-progress-animation"
                                        :class="{'vehica-button--with-progress-animation--active': props.inProgress}"
                                        :disabled="props.inProgress"
                                >
                                    <span><?php echo esc_html(vehicaApp('save_string')); ?></span>

                                    <template>
                                        <svg
                                                v-if="props.inProgress"
                                                width="120"
                                                height="30"
                                                wviewBox="0 0 120 30"
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="#fff"
                                        >
                                            <circle cx="15" cy="15" r="15">
                                                <animate attributeName="r" from="15" to="15"
                                                         begin="0s" dur="0.8s"
                                                         values="15;9;15" calcMode="linear"
                                                         repeatCount="indefinite"/>
                                                <animate attributeName="fill-opacity" from="1" to="1"
                                                         begin="0s" dur="0.8s"
                                                         values="1;.5;1" calcMode="linear"
                                                         repeatCount="indefinite"/>
                                            </circle>
                                            <circle cx="60" cy="15" r="9" fill-opacity="0.3">
                                                <animate attributeName="r" from="9" to="9"
                                                         begin="0s" dur="0.8s"
                                                         values="9;15;9" calcMode="linear"
                                                         repeatCount="indefinite"/>
                                                <animate attributeName="fill-opacity" from="0.5" to="0.5"
                                                         begin="0s" dur="0.8s"
                                                         values=".5;1;.5" calcMode="linear"
                                                         repeatCount="indefinite"/>
                                            </circle>
                                            <circle cx="105" cy="15" r="15">
                                                <animate attributeName="r" from="15" to="15"
                                                         begin="0s" dur="0.8s"
                                                         values="15;9;15" calcMode="linear"
                                                         repeatCount="indefinite"/>
                                                <animate attributeName="fill-opacity" from="1" to="1"
                                                         begin="0s" dur="0.8s"
                                                         values="1;.5;1" calcMode="linear"
                                                         repeatCount="indefinite"/>
                                            </circle>
                                        </svg>
                                    </template>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </vehica-panel-change-social>
</div>