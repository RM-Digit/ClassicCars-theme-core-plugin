<?php


namespace Vehica\Managers;


use Vehica\Core\Manager;
use Vehica\Model\Post\Car;
use Vehica\Model\Post\Field\Taxonomy\Taxonomy;
use Vehica\Model\Term\Term;

/**
 * Class TermRelationManager
 * @package Vehica\Managers
 */
class TermRelationManager extends Manager
{

    public function boot()
    {
        add_action('admin_post_vehica_connect_terms', [$this, 'init']);

        add_action('vehica/terms/connect', [$this, 'check']);
    }

    public function init()
    {
        if (!current_user_can('manage_options')) {
            return;
        }

        $this->check();

        wp_redirect(admin_url('admin.php?page=vehica_panel_advanced'));
        exit;
    }

    public function check()
    {
        Car::getAll()->each(function ($car) {
            vehicaApp('child_taxonomies')->each(function ($childTaxonomy) use ($car) {
                $this->connect($car, $childTaxonomy);
            });
        });
    }

    /**
     * @param Car $car
     * @param Taxonomy $childTaxonomy
     */
    private function connect(Car $car, Taxonomy $childTaxonomy)
    {
        $parentTaxonomies = $childTaxonomy->getParentTaxonomies();
        foreach ($parentTaxonomies as $parentTaxonomy) {
            if (!$parentTaxonomy) {
                continue;
            }

            $parentTerms = $car->getTerms($parentTaxonomy);

            $car->getTerms($childTaxonomy)->each(static function ($childTerm) use ($parentTerms) {
                $childTerm->setParentTerm($parentTerms->map(static function ($parentTerm) {
                    /* @var Term $parentTerm */
                    return $parentTerm->getId();
                })->all());
            });
        }
    }

}