<?php
namespace Craft;

class AmFields_EntryFieldType extends BaseElementFieldType
{
    /**
     * List of built-in component aliases to be imported.
     *
     * @var string $elementType
     */
    protected $elementType = ElementType::Entry;

    /**
     * Whether to allow multiple source selection in the settings.
     *
     * @var bool $allowMultipleSources
     */
    protected $allowMultipleSources = false;

    /**
     * Whether the elements have a custom sort order.
     *
     * @var bool $sortable
     */
    protected $sortable = false;

    /**
     * @inheritDoc IComponentType::getName()
     *
     * @return string
     */
    public function getName()
    {
        return Craft::t('Entry relation filter by a field');
    }

    /**
     * @inheritDoc ISavableComponentType::getSettingsHtml()
     *
     * @return string|null
     */
    public function getSettingsHtml()
    {
        // Get parent settings
        $settings = parent::getSettingsHtml();

        // Get available fields
        $fields = array();
        foreach (craft()->fields->getAllFields() as $field) {
            $fields[$field->handle] = $field->name;
        }

        // Add our settings
        $fieldSelectTemplate = craft()->templates->render('amfields/entry/_settings', array(
            'fields' => $fields,
            'filterField' => $this->getSettings()->filterField,
        ));

        // Return both
        return $settings.$fieldSelectTemplate;
    }

    /**
     * Returns any additional criteria parameters limiting which elements the field should be able to select.
     *
     * @return array
     */
    protected function getInputSelectionCriteria()
    {
        $filterField = $this->getSettings()->filterField;

        if ($this->element->$filterField instanceof ElementCriteriaModel) {
            $sourceElement = $this->element->$filterField->first();

            if ($sourceElement) {
                return array(
                    'relatedTo' => array(
                        'sourceElement' => $sourceElement->id,
                    )
                );
            }
        }

        return array();
    }

    /**
     * @inheritDoc BaseSavableComponentType::defineSettings()
     *
     * @return array
     */
    protected function defineSettings()
    {
        // Default settings
        $settings = parent::defineSettings();

        // Filter field setting
        $settings['filterField'] = AttributeType::String;

        // Return settings
        return $settings;
    }
}
