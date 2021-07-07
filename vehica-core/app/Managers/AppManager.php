<?php


namespace Vehica\Managers;


use Vehica\Core\Manager;

/**
 * Class AppManager
 * @package Vehica\Managers
 */
class AppManager extends Manager
{

    public function boot()
    {
        add_action('admin_init', [$this, 'check']);
    }

    public function check()
    {
        $version = get_option('vehica_version');
        if ($version !== vehicaApp('version')) {
            $this->cleanUp();

            update_option('vehica_version', vehicaApp('version'));
        }
    }

    private function cleanUp()
    {
        do_action('vehica_flush_rewrites');
    }

}