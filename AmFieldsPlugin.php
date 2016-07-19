<?php
/**
 * FieldTypes for Craft.
 *
 * @package   Am Fields
 * @author    Hubert Prein
 */
namespace Craft;

class AmFieldsPlugin extends BasePlugin
{
    /**
     * @return null|string
     */
    public function getName()
    {
        return Craft::t('a&m fields');
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return '1.0.0';
    }

    /**
     * @return string
     */
    public function getSchemaVersion()
    {
        return '1.0.0';
    }

    /**
     * @return string
     */
    public function getDeveloper()
    {
        return 'a&m impact';
    }

    /**
     * @return string
     */
    public function getDeveloperUrl()
    {
        return 'http://www.am-impact.nl';
    }
}
