<?php
namespace Craft;

class AmFields_EntryLocaleFieldType extends BaseElementFieldType
{
    /**
     * List of built-in component aliases to be imported.
     *
     * @var string $elementType
     */
    protected $elementType = ElementType::Entry;

    /**
     * @inheritDoc IComponentType::getName()
     *
     * @return string
     */
    public function getName()
    {
        return Craft::t('Entries with locale filter');
    }

    /**
     * Returns any additional criteria parameters limiting which elements the field should be able to select.
     *
     * @return array
     */
    protected function getInputSelectionCriteria()
    {
        return array(
            'locale' => $this->element->locale,
        );
    }
}
