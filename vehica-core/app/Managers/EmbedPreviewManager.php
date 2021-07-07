<?php


namespace Vehica\Managers;


use Vehica\Core\Manager;
use Vehica\Model\Post\Field\EmbedField;

/**
 * Class EmbedPreviewManager
 * @package Vehica\Managers
 */
class EmbedPreviewManager extends Manager
{

    public function boot()
    {
        add_action('admin_post_nopriv_vehica_embed_preview', [$this, 'preview']);
        add_action('admin_post_vehica_embed_preview', [$this, 'preview']);
    }

    public function preview()
    {
        if (empty($_POST['url']) || empty($_POST['fieldId'])) {
            return;
        }

        $embed = wp_oembed_get($_POST['url']);
        $fieldId = (int)$_POST['fieldId'];
        $field = vehicaApp('embed_fields')->find(static function ($embedField) use ($fieldId) {
            /* @var EmbedField $embedField */
            return $embedField->getId() === $fieldId;
        });

        if (!$field instanceof EmbedField) {
            return;
        }

        if (empty($embed) && $field->allowRawHtml()) {
            echo stripslashes_deep($_POST['url']);
            return;
        }

        echo vehica_filter($embed);
    }

}