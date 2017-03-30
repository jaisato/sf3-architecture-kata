<?php
declare(strict_types=1);

namespace Component\Php;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @link http://symfony.com/doc/current/components/options_resolver.html
 *
 * @author      Daniel Funes <dfunes@intercomempresas.com>
 * @package     Component\Php
 * @copyright   2006-2017 Verticales Intercom, S.L.
 */
class OptionsResolverDecorator
{
    /** @var  OptionsResolver */
    public $optionsResolver;

    private $options;

    public function __construct()
    {
        $this->optionsResolver = new OptionsResolver();
        $this->configureOptions();
    }

    private function configureOptions()
    {
        // TODO
    }

    /**
     * Sets $options
     * @param array $options
     */
    public function setOptions(array $options)
    {
        $this->optionsResolver->setDefaults($options);
    }

    public function getOption(string $option)
    {
        return $this->options[$option];
    }
}
