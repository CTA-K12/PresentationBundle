<?php

namespace Mesd\PresentationBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('mesd_presentation');

        $rootNode
            ->children()
                ->arrayNode('templates')
                    ->children()
                        ->scalarNode('box')
                            ->defaultValue('MesdPresentationBundle:TwigExtensions:box.html.twig')
                        ->end()
                        ->scalarNode('form')
                            ->defaultValue('MesdPresentationBundle:TwigExtensions:form.html.twig')
                        ->end()
                        ->scalarNode('help_wiki')
                            ->defaultValue('MesdPresentationBundle:TwigExtensions:help_wiki.html.twig')
                        ->end()
                        ->scalarNode('menu')
                            ->defaultValue('MesdPresentationBundle:TwigExtensions:menu.html.twig')
                        ->end()
                        ->scalarNode('user')
                            ->defaultValue('MesdPresentationBundle:TwigExtensions:user.html.twig')
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('globals')
                    ->children()
                        ->scalarNode('trans_domain')->defaultValue('mesd_presentation')->end()
                        ->scalarNode('app_name')->defaultValue('')->end()
                        ->scalarNode('app_abbreviation')->defaultValue('')->end()
                        ->scalarNode('app_description')->defaultValue('')->end()
                        ->scalarNode('app_keywords')->defaultValue('')->end()
                        ->scalarNode('app_url')->defaultValue('')->end()
                        ->scalarNode('app_version')->defaultValue('')->end()
                        ->scalarNode('app_license_1')->defaultValue('')->end()
                        ->scalarNode('app_license_url_1')->defaultValue('')->end()
                        ->scalarNode('app_license_2')->defaultValue('')->end()
                        ->scalarNode('app_license_url_2')->defaultValue('')->end()
                        ->scalarNode('org_name')->defaultValue('')->end()
                        ->scalarNode('org_abbreviation')->defaultValue('')->end()
                        ->scalarNode('org_description')->defaultValue('')->end()
                        ->scalarNode('org_address')->defaultValue('')->end()
                        ->scalarNode('org_telephone')->defaultValue('')->end()
                        ->scalarNode('org_email')->defaultValue('')->end()
                        ->scalarNode('org_url')->defaultValue('')->end()
                        ->scalarNode('login_path')->defaultValue('')->end()
                        ->scalarNode('login_check_path')->defaultValue('')->end()
                        ->scalarNode('logout_path')->defaultValue('')->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
