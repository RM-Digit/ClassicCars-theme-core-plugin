<?php


namespace Vehica\Widgets\Car\Single;


use Elementor\Controls_Manager;

/**
 * Class BigFeaturesSingleCarWidget
 * @package Vehica\Widgets\Car\Single
 */
class BigFeaturesSingleCarWidget extends FeaturesSingleCarWidget
{
    const NAME = 'vehica_big_features_single_car_widget';
    const TEMPLATE = 'car/single/big_features';

    /**
     * @return string
     */
    public function get_title()
    {
        return esc_html__('Big Features', 'vehica-core');
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            self::NAME,
            [
                'label' => esc_html__('General', 'vehica-core'),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );

        $this->addFeatureControls();

        $this->addTextTypographyControl(
            'vehica_big_feature',
            '.vehica-car-features-pills__single'
        );

        $this->addTextColorControl(
            'vehica_big_feature',
            '.vehica-car-features-pills__single'
        );

        $this->addBackgroundColorControl(
            'vehica_big_feature',
            '.vehica-car-features-pills__single'
        );

        $this->addBorderColorControl(
            'vehica_big_feature',
            '.vehica-car-features-pills__single'
        );

        $this->addPaddingControl(
            'vehica_big_feature',
            '.vehica-car-features-pills__single'
        );

        $this->addShowControl('icon', esc_html__('Display Icon'));

        $this->end_controls_section();
    }

}