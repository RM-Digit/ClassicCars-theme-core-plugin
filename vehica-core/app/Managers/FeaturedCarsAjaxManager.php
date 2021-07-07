<?php


namespace Vehica\Managers;


use Vehica\Api\CarsApi;
use Vehica\Components\Card\Car\Card;
use Vehica\Components\FeaturedCars;
use Vehica\Core\Manager;

/**
 * Class FeaturedCarsAjaxManager
 * @package Vehica\Managers
 */
class FeaturedCarsAjaxManager extends Manager
{

    public function boot()
    {
        add_action('wp_ajax_vehica_featured_cars', [$this, 'cars']);
        add_action('wp_ajax_nopriv_vehica_featured_cars', [$this, 'cars']);
    }

    public function cars()
    {
        if (!isset($_POST['cardConfig'], $_POST['queryParams'])) {
            return;
        }

        $cardConfig = $_POST['cardConfig'];
        $queryParams = $_POST['queryParams'];
        $queryParams['limit'] = 20;

        if (!is_array($cardConfig) || !is_array($queryParams)) {
            return;
        }

        global $vehicaCarCard;
        $vehicaCarCard = Card::create($cardConfig);
        $api = CarsApi::make($queryParams);
        $api->disableTermsCount();

        global $vehicaFeaturedCars;
        $vehicaFeaturedCars = new FeaturedCars($api->getCars());

        get_template_part('templates/shared/featured_cars');

        die;
    }

}