<?php
/* @var \Vehica\Model\Post\Car $vehicaCar */
global $vehicaCar;
if (!$vehicaCar) {
    return;
}

$vehicaUser = $vehicaCar->getUser();
if (!$vehicaUser || !$vehicaUser->hasPhone() || !$vehicaUser->isWhatsAppActive() || !vehicaApp('settings_config')->isWhatsAppEnabled()) {
    return;
}
?>
<div class="vehica-whats-app-button">
    <a href="https://api.whatsapp.com/send?phone=<?php echo esc_attr($vehicaUser->getPhoneUrl()); ?>">
        <i class="fab fa-whatsapp"></i><?php echo esc_html(vehicaApp('chat_via_whatsapp_string')); ?>
    </a>
</div>
