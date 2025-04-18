<?php
/** generated from /home/tac/g/sites/survos/vendor/survos/maker-bundle/templates/skeleton/bundle/src/Bundle.tpl.php */

namespace Survos\TranslatableFieldBundle;

use Survos\TranslatableFieldBundle\EasyAdmin\Field\Configurator\TranslationsConfigurator;
use Survos\TranslatableFieldBundle\EasyAdmin\Field\TranslationsField;
use Survos\TranslatableFieldBundle\Form\Extension\TranslationsTypeExtension;
use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;
use function Symfony\Component\DependencyInjection\Loader\Configurator\tagged_iterator;


class SurvosTranslatableFieldBundle extends AbstractBundle
{
    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        // $builder->setParameter('survos_workflow.direction', $config['direction']);

//        $builder->autowire(TranslationsField::class)->setPublic(true);

        $builder->autowire(TranslationsConfigurator::class)
            ->setAutoconfigured(true)
            ->setPublic(true)
            ->addTag('ea.field_configurator', [
                'priority' => -10,
            ])
//        $fieldConfigurators: !tagged_iterator ea.field_configurator
            ->setArgument('$fieldConfigurators', tagged_iterator('ea.field_configurator'))
        ;

        // https://symfony.com/doc/current/reference/dic_tags.html#form-type-extension
        $builder->autowire(TranslationsTypeExtension::class)
            ->setAutoconfigured(true)
            ->setPublic(true)
            ->addTag('form.type_extension', [])
            ;


        /*
        $definition = $builder
        ->autowire('survos.barcode_twig', BarcodeTwigExtension::class)
        ->addTag('twig.extension');

        $definition->setArgument('$widthFactor', $config['widthFactor']);
        $definition->setArgument('$height', $config['height']);
        $definition->setArgument('$foregroundColor', $config['foregroundColor']);
        */

    }

    public function configure(DefinitionConfigurator $definition): void
    {
        $definition->rootNode()
            ->children()
            ->scalarNode('direction')->defaultValue('LR')->end()
            ->scalarNode('base_layout')->defaultValue('base.html.twig')->end()
            ->arrayNode('entities')
            ->scalarPrototype()
            ->end()->end()
            ->booleanNode('enabled')->defaultTrue()->end()
//            ->integerNode('min_sunshine')->defaultValue(3)->end()
            ->end();
    }

}
