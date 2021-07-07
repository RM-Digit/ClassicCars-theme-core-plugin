<?php


namespace Vehica\Managers;


use Vehica\Addons\WPAllImport;
use Vehica\Core\Manager;
use Vehica\Field\Fields\Price\Price;
use Vehica\Model\Post\Car;
use Vehica\Model\Post\Field\EmbedField;
use Vehica\Model\Post\Field\Field;
use Vehica\Model\Post\Field\GalleryField;
use Vehica\Model\Post\Field\LocationField;
use Vehica\Model\Post\Field\NumberField;
use Vehica\Model\Post\Field\Price\PriceField;
use Vehica\Model\Post\Field\TextField;

/**
 * Class WPAllImportManager
 * @package Vehica\Managers
 */
class WPAllImportManager extends Manager
{

    public function boot()
    {
        add_action('admin_footer', static function () {
            if (!defined('PMXI_VERSION')) {
                return;
            }
            ?>
            <script>
                jQuery(document).ready(function () {
                    if (jQuery('input[name=records_per_request]').length > 0) {
                        jQuery('input[name=records_per_request]').val(1)
                    }

                    if (jQuery('.wpallimport-featured-images .wpallimport-collapsed-content-inner').length > 0) {
                        jQuery('.wpallimport-featured-images .wpallimport-collapsed-content-inner').prepend('<a href="https://support.vehica.com/knowledgebase/import-any-xml-or-csv-file-free-wp-all-import-compatibility/#import-images" target="_blank" class="vehica-wp-allimport-doc-link"><?php esc_html_e('Click here to read Vehica Documentation - How to Import Images?', 'vehica-core'); ?></a>')
                    }

                    if (jQuery('[rel=taxonomies_hints]').length > 0) {
                        jQuery('[rel=taxonomies_hints]').after('<div style="margin: 10px 90px 20px 0; font-size: 18px; line-height: 28px;"><i class="fas fa-info-circle"></i> <strong>Vehica has its own Taxonomy Hierarchy System</strong>. If you have some kind of hierarchy in your database (e.g. Make > Model) you can Connect Terms (Parent/Child) just after import this way - <a target="_blank" href="https://support.vehica.com/knowledgebase/associate-existing-child-record-to-existing-parent-record-connect-terms-parent-child/">click here</a>.</div>')
                    }
                });
            </script>
            <?php
        });

        add_action('init', function () {
            if (!defined('PMXI_VERSION')) {
                return;
            }

            $vehicaAddon = new WPAllImport('Custom Fields: Text Fields, Number Fields, Price, Location, Embed', 'vehica');
            $vehicaAddon->run(['themes' => ['Vehica']]);

            vehicaApp('car_fields')->each(function ($field) use ($vehicaAddon) {
                /* @var Field $field */
                if ($field instanceof TextField || ($field instanceof NumberField && !$field instanceof PriceField)) {
                    $this->addRegularField($field, $vehicaAddon);
                } elseif ($field instanceof PriceField) {
                    $this->addPriceField($field, $vehicaAddon);
                } elseif ($field instanceof GalleryField) {
                    $this->addGalleryField($field, $vehicaAddon);
                } elseif ($field instanceof LocationField) {
                    $this->addLocationField($field, $vehicaAddon);
                } elseif ($field instanceof EmbedField) {
                    $this->addEmbedField($field, $vehicaAddon);
                }
            });

            $vehicaAddon->set_import_function([$this, 'import']);
        }, 100);

        add_filter('wp_all_import_config_options', static function ($options) {
            $options['chunk_size'] = 1;
            $options['log_storage'] = 1;
            $options['large_feed_limit'] = 1;

            return $options;
        });
    }

    /**
     * @param int $postId
     * @param array $data
     * @param $importOptions
     * @param $article
     * @noinspection PhpUnusedParameterInspection
     */
    public function import($postId, $data, $importOptions, $article)
    {
        $car = Car::getById($postId);
        if (!$car instanceof Car) {
            return;
        }

        if (vehicaApp('number_fields')) {
            foreach (vehicaApp('number_fields') as $numberField) {
                /* @var NumberField $numberField */
                if (!$numberField instanceof PriceField && isset($data[$numberField->getKey()])) {
                    $numberField->save($car, $data[$numberField->getKey()]);
                }
            }
        }

        if (vehicaApp('text_fields')) {
            foreach (vehicaApp('text_fields') as $textField) {
                /* @var NumberField $textField */
                if (isset($data[$textField->getKey()])) {
                    $textField->save($car, $data[$textField->getKey()]);
                }
            }
        }

        if (vehicaApp('price_fields')) {
            foreach (vehicaApp('price_fields') as $priceField) {
                $values = [];

                /* @var PriceField $priceField */
                foreach ($priceField->getPrices() as $price) {
                    /* @var Price $price */
                    if (isset($data[$price->getKey()])) {
                        $values[$price->getKey()] = $data[$price->getKey()];
                    }
                }

                $priceField->save($car, $values);
            }
        }

        if (vehicaApp('location_fields')) {
            foreach (vehicaApp('location_fields') as $locationField) {
                /* @var LocationField $locationField */
                $locationFieldKey = $locationField->getKey();
                if (isset($data[$locationFieldKey . '_address'], $data[$locationFieldKey . '_lat'], $data[$locationFieldKey . '_lng'])) {
                    $locationField->save($car, [
                        'address' => $data[$locationFieldKey . '_address'],
                        'position' => [
                            'lat' => $data[$locationFieldKey . '_lat'],
                            'lng' => $data[$locationFieldKey . '_lng'],
                        ]
                    ]);
                }
            }
        }

        if (vehicaApp('embed_fields')) {
            foreach (vehicaApp('embed_fields') as $embedField) {
                /* @var EmbedField $embedField */
                $embedFieldKey = $embedField->getKey();

                if (isset($data[$embedField->getKey() . '_embed'], $data[$embedFieldKey . '_url'])) {
                    $embedField->save($car, [
                        'embed' => $data[$embedFieldKey . '_embed'],
                        'url' => $data[$embedFieldKey . '_url'],
                    ]);
                }
            }
        }
    }

    /**
     * @param Field $field
     * @param WPAllImport $rapidAddon
     */
    public function addRegularField(Field $field, WPAllImport $rapidAddon)
    {
        $rapidAddon->add_field($field->getKey(), $field->getName(), 'text');
    }

    /**
     * @param PriceField $priceField
     * @param WPAllImport $rapidAddon
     */
    public function addPriceField(PriceField $priceField, WPAllImport $rapidAddon)
    {
        foreach ($priceField->getPrices() as $price) {
            /* @var Price $price */
            $rapidAddon->add_field($price->getKey(), $price->getName(), 'text');
        }
    }

    /**
     * @param GalleryField $galleryField
     * @param WPAllImport $rapidAddon
     * @noinspection PhpUnusedParameterInspection
     */
    public function addGalleryField(GalleryField $galleryField, WPAllImport $rapidAddon)
    {
        $rapidAddon->import_images($galleryField->getKey(), $galleryField->getName() . ' (Vehica Field)', 'images', static function ($postId, $attachmentId, $imageFilepath, $importOptions) use ($galleryField) {
            $car = Car::getById($postId);
            if (!$car) {
                return;
            }

            $value = $galleryField->getValue($car);
            $value[] = $attachmentId;

            $galleryField->save($car, implode(',', $value));
        });
    }

    /**
     * @param LocationField $locationField
     * @param WPAllImport $rapidAddon
     */
    public function addLocationField(LocationField $locationField, WPAllImport $rapidAddon)
    {
        $rapidAddon->add_field($locationField->getKey() . '_lat', $locationField->getName() . ' - Latitude', 'text');

        $rapidAddon->add_field($locationField->getKey() . '_lng', $locationField->getName() . ' - Longitude', 'text');

        $rapidAddon->add_field($locationField->getKey() . '_address', $locationField->getName() . ' - Address', 'text');
    }

    /**
     * @param EmbedField $embedField
     * @param WPAllImport $rapidAddon
     */
    public function addEmbedField(EmbedField $embedField, WPAllImport $rapidAddon)
    {
        $rapidAddon->add_field($embedField->getKey() . '_embed', $embedField->getName() . ' - embed code (e.g. iframe)', 'text');

        $rapidAddon->add_field($embedField->getKey() . '_url', $embedField->getName() . ' - embed url (e.g. https://****.com )', 'text');
    }

}