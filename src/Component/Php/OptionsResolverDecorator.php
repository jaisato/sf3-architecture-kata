<?php

declare(strict_types=1);

namespace App\Component\Php;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @see https://symfony.com/doc/7.4/components/options_resolver.html
 *
 * @author      Daniel Funes <dfunes@intercomempresas.com>
 * @copyright   2006-2017 Verticales Intercom, S.L.
 */
class OptionsResolverDecorator
{
    public OptionsResolver $optionsResolver;

    /** @var array<array-key, mixed> Options resolved by setOptions() */
    private array $options = [];

    public function __construct()
    {
        $this->optionsResolver = new OptionsResolver();
        $this->configureOptions();
    }

    private function configureOptions(): void
    {
        $this->optionsResolver
            ->setRequired(['host', 'company'])
            ->setDefined('port')
            ->setAllowedTypes('port', 'int')
            ->setDefault('name', 'Jhon Snow');
    }

    /**
     * Resolves the given options: validates them and fills in the defaults.
     *
     * @param array<string, mixed> $options
     */
    public function setOptions(array $options): void
    {
        $this->options = $this->optionsResolver->resolve($options);
    }

    public function getOption(string $option): mixed
    {
        return $this->options[$option] ?? null;
    }
}
