<?php

namespace Vehica\Core\Field;


use Vehica\Core\Collection;

/**
 * Class GalleryAttribute
 * @package Vehica\Core\Field
 */
class GalleryAttribute extends Attribute
{
    /**
     * @return array
     */
    public function getImageIds()
    {
        $imageIds = $this->field->getValue($this->fieldsUser);

        if (!is_array($imageIds)) {
            return [];
        }

        return $imageIds;
    }

    /**
     * @return int|false
     */
    private function getFirstImageId()
    {
        $imageIds = $this->getImageIds();

        if (empty($imageIds)) {
            return false;
        }

        return (int)$imageIds[0];
    }

    /**
     * @param string $size
     * @return string|false
     */
    public function getImageUrl($size = 'large')
    {
        $imageId = $this->getFirstImageId();

        if (!$imageId) {
            return false;
        }

        return wp_get_attachment_image_url($this->getFirstImageId(), $size);
    }

    /**
     * @return array
     */
    public function getJsonData()
    {
        return [
            'images' => Collection::make($this->getImageIds())->map(static function ($imageId) {
                $key = 'image_' . $imageId;
                if (vehicaApp()->has($key)) {
                    /* @var \Vehica\Model\Post\Image $image */
                    $image = vehicaApp($key);
                    return [
                        'url' => $image->getUrl('large'),
                        'thumb' => $image->getUrl('standard')
                    ];
                }

                return [
                    'url' => vehicaApp('image_url', $imageId, 'large'),
                    'thumb' => vehicaApp('image_url', $imageId, 'standard')
                ];
            })->all()
        ];
    }

}