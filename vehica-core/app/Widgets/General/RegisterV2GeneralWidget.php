<?php


namespace Vehica\Widgets\General;


use Elementor\Controls_Manager;

/**
 * Class RegisterV2GeneralWidget
 * @package Vehica\Widgets\General
 */
class RegisterV2GeneralWidget extends GeneralWidget
{
    const NAME = 'vehica_register_v2_general_widget';
    const TEMPLATE = 'general/register_v2';

    /**
     * @return string
     */
    public function get_title()
    {
        return esc_html__('Register Form V2', 'vehica-core');
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
            'vehica_policy',
            [
                'label' => esc_html__('I accept Private Policy / Terms of Use', 'vehica-core'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'I accept the <a href="#">privacy policy </a>'
            ]
        );

        $this->end_controls_section();
    }

    /**
     * @return string
     */
    public function getPolicyLabel()
    {
        return (string)$this->get_settings_for_display('vehica_policy');
    }

    /**
     * @return bool
     */
    public function hasPolicyLabel()
    {
        return !empty($this->getPolicyLabel());
    }

    /**
     * @return bool
     */
    public function showPhoneNumberField()
    {
        $phoneSetting = vehicaApp('settings_config')->getPanelPhoneNumber();

        return $phoneSetting === 'optional_show' || $phoneSetting === 'required';
    }

    /**
     * @return bool
     */
    public function isPhoneNumberFieldRequired()
    {
        return vehicaApp('settings_config')->getPanelPhoneNumber() === 'required';
    }

}