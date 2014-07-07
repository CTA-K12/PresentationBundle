<?php

namespace Mesd\PresentationBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $treeBuilder->root('mesd_presentation')
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('allow_registration')
                    ->defaultValue(false)
                ->end()
                ->scalarNode('allow_password_reset')
                    ->defaultValue(false)
                ->end()
                ->scalarNode('app_name')
                    ->defaultValue('App')
                ->end()
                ->scalarNode('app_abbreviation')
                    ->defaultValue('APP')
                ->end()
                ->scalarNode('app_description')
                    ->defaultValue('App Description')
                ->end()
                ->scalarNode('app_url')
                    ->defaultValue('http://myurl.domain/app')
                ->end()
                ->scalarNode('app_keywords')
                    ->defaultValue('App Key Words')
                ->end()
                ->scalarNode('app_version')
                    ->defaultValue('0.0.0')
                ->end()
                ->scalarNode('app_license_1')
                    ->defaultValue('My License')
                ->end()
                ->scalarNode('app_license_url_1')
                    ->defaultValue('http://myurl.domain/my_license')
                ->end()
                ->scalarNode('app_license_2')
                    ->defaultValue('MIT')
                ->end()
                ->scalarNode('app_license_url_2')
                    ->defaultValue('http://symfony.com/doc/current/contributing/code/license.html')
                ->end()
                ->scalarNode('login_check_path')
                    ->defaultValue('#')
                ->end()
                ->scalarNode('login_path')
                    ->defaultValue('#')
                ->end()
                ->scalarNode('login_target_path')
                    ->defaultValue('#')
                ->end()
                ->scalarNode('logout_path')
                    ->defaultValue('#')
                ->end()
                ->scalarNode('org_name')
                    ->defaultValue('Org')
                ->end()
                ->scalarNode('org_abbreviation')
                    ->defaultValue('ORG')
                ->end()
                ->scalarNode('org_address')
                    ->defaultValue('Org Address')
                ->end()
                ->scalarNode('org_telephone')
                    ->defaultValue('Org Phone No')
                ->end()
                ->scalarNode('org_email')
                    ->defaultValue('Org Email Address')
                ->end()
                ->scalarNode('org_url')
                    ->defaultValue('http://myurl.domain')
                ->end()
                ->scalarNode('password_reset_text')
                    ->defaultValue('Forgot Password?')
                ->end()
                ->scalarNode('password_reset_path')
                    ->defaultValue('#')
                ->end()
                ->scalarNode('registration_text')
                    ->defaultValue('Create Account?')
                ->end()
                ->scalarNode('registration_path')
                    ->defaultValue('#')
                ->end()
                ->scalarNode('user_profile_path')
                    ->defaultValue('#')
                ->end()
                ->scalarNode('user_settings_path')
                    ->defaultValue('#')
                ->end()
            ->end();

        return $treeBuilder;
    }
}
