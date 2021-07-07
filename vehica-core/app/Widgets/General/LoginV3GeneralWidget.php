<?php


namespace Vehica\Widgets\General;


use Elementor\Controls_Manager;

/**
 * Class LoginV3GeneralWidget
 * @package Vehica\Widgets\General
 */
class LoginV3GeneralWidget extends LoginGeneralWidget
{
    const NAME = 'vehica_login_v3_general_widget';
    const TEMPLATE = 'general/login/login_v3';

    /**
     * @return string
     */
    public function get_title()
    {
        return esc_html__('Login Form V2', 'vehica-core');
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

        $this->add_control(
            'no_options',
            [
                'label' => esc_html__('No settings', 'vehica-core'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->end_controls_section();
    }

}