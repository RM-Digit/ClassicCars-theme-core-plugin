<?php

namespace Vehica\Model\Post\Field;

if (!defined('ABSPATH')) {
    exit;
}

use Vehica\Core\Collection;
use Vehica\Core\Field\GalleryAttribute;
use Vehica\Core\Model\Field\FieldsUser;

/**
 * Class GalleryField
 * @package Vehica\CustomField\Fields
 */
class GalleryField extends Field
{
    const KEY = 'gallery';

    /**
     * @param FieldsUser $fieldsUser
     * @return GalleryAttribute
     */
    public function getAttribute(FieldsUser $fieldsUser)
    {
        return new GalleryAttribute($this, $fieldsUser);
    }

    /**
     * @param FieldsUser $fieldsUser
     * @param string $value
     */
    public function save(FieldsUser $fieldsUser, $value)
    {
        if (isset($_POST['vehica_source']) && $_POST['vehica_source'] === 'backend' && empty($_POST[$this->getKey() . '_loaded'])) {
            return;
        }

        $fieldsUser->setMeta($this->getKey(), $value);
    }

    /**
     * @param FieldsUser $fieldsUser
     * @return array
     */
    public function getValue(FieldsUser $fieldsUser)
    {
        if (!$this->isVisible()) {
            return [];
        }

        $images = $fieldsUser->getMeta($this->getKey());
        if (empty($images)) {
            return [];
        }

        $images = explode(',', $images);
        if (empty($images) || !is_array($images)) {
            return [];
        }

        return Collection::make($images)->map(static function ($imageId) {
            return (int)$imageId;
        })->filter(static function ($imageId) {
            return !empty($imageId);
        })->all();
    }

}