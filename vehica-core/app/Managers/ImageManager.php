<?php

namespace Vehica\Managers;

if ( ! defined('ABSPATH')) {
    exit;
}

use Vehica\Core\Collection;
use Vehica\Core\Manager;
use Vehica\Model\Post\Image;

/**
 * Class ImageManager
 * @package Vehica\Managers
 */
class ImageManager extends Manager
{

    public function boot()
    {
        add_action('after_setup_theme', [$this, 'registerSizes']);
        add_action('admin_post_vehica_gallery_info', [$this, 'galleryInfo']);
    }

    public function galleryInfo()
    {
        if (empty($_POST['gallery']) || ! is_array($_POST['gallery'])) {
            return;
        }

        echo json_encode(Image::getImages($_POST['gallery'])->map(static function ($image) {
            /* @var Image $image */
            return [
                'mcID' => $image->getId(),
                'name' => $image->getName(),
                'url'  => $image->getSrc(),
            ];
        })->all());
    }

    public function registerSizes()
    {
        /** @noinspection PhpIncludeInspection */
        Collection::make(require vehicaApp('path') . '/config/imagesizes.php')->each(static function ($imageSize) {
            add_image_size($imageSize['key'], $imageSize['width'], $imageSize['height'], $imageSize['crop']);
        });
    }
}