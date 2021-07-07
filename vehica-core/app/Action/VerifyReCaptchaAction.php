<?php


namespace Vehica\Action;


use ReCaptcha\ReCaptcha;

/**
 * Class VerifyReCaptchaAction
 * @package Vehica\Action
 */
class VerifyReCaptchaAction
{
    /**
     * @param string $action
     * @param string $token
     * @return bool
     */
    public static function verify($action, $token)
    {
        return (new ReCaptcha(vehicaApp('settings_config')->getRecaptchaSecret()))
            ->setExpectedAction($action)
            ->setScoreThreshold(0.5)
            ->verify($token)
            ->isSuccess();
    }

}