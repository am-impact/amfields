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
     * @inheritDoc ISavableComponentType::getSettingsHtml()
     *
     * @return string|null
     */
    public function getSettingsHtml()
    {
        // Get parent settings
        $settings = parent::getSettingsHtml();

        // Get element type
        $elementType = $this->getElementType();

        // Add our settings
        $fieldSelectTemplate = craft()->templates->render('amfields/entryLocale/_settings', array(
            'status'   => $this->getSettings()->status,
            'statuses' => array_merge(array('' => Craft::t('No')), $elementType->getStatuses()),
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
        // Set criteria
        $criteria = array(
            'locale' => $this->element->locale,
        );

        // Specific status?
        $status = $this->getSettings()->status;
        if (! empty($status)) {
            $criteria['status'] = $status;
        }

        return $criteria;
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
        $settings['status'] = AttributeType::String;

        // Return settings
        return $settings;
    }
}
