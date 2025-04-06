<?php

namespace Survos\TranslatableFieldBundle\EasyAdmin\Field;

use A2lix\TranslationFormBundle\Form\Type\TranslationsType;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;

class TranslationsField implements FieldInterface
{
    use FieldTrait;

    public const OPTION_FIELDS_CONFIG = 'fieldsConfig';

    public static function new(string $propertyName, ?string $label = null): self
    {
        $formThemePath = realpath(__DIR__ . '/../../../templates/field/translations.html.twig');
        assert(file_exists($formThemePath), $formThemePath);
        return (new self())
            ->setProperty($propertyName)
            ->setLabel($label)
            ->onlyOnForms()
            ->setRequired(true)
//            ->addFormTheme($formThemePath)
//            ->addCssFiles('build/translations-field.css')
            ->setFormType(TranslationsType::class)
            ->setFormTypeOption('block_prefix', 'translations_field')
            ;
    }

    public function addTranslatableField(FieldInterface $field): self
    {
        $fieldsConfig = (array)$this->getAsDto()->getCustomOption(self::OPTION_FIELDS_CONFIG);
        $fieldsConfig[] = $field;

        $this->setCustomOption(self::OPTION_FIELDS_CONFIG, $fieldsConfig);

        return $this;
    }
}
