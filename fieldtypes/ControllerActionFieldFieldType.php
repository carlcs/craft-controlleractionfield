<?php
namespace Craft;

class ControllerActionFieldFieldType extends BaseFieldType
{
    // Public Methods
    // =========================================================================

    /**
     * Returns the component's name.
     *
     * @return string
     */
    public function getName()
    {
        return Craft::t('Controller Action');
    }

    /**
     * Returns the field's content attribute config.
     *
     * @return mixed
     */
    public function defineContentAttribute()
    {
        return false;
    }

    /**
     * Returns the component's settings HTML.
     *
     * @return string|null
     */
    public function getSettingsHtml()
    {
        return craft()->templates->render('controlleractionfield/fieldtypes/controlleraction/settings', array(
            'settings' => $this->getSettings(),
            'placeholders' => $this->getPlaceholderStrings(),
        ));
    }

    /**
     * Returns the field's input HTML.
     *
     * @param string $name
     * @param mixed  $value
     *
     * @return string
     */
    public function getInputHtml($name, $value)
    {
        craft()->templates->includeJsResource('controlleractionfield/fieldtypes/controlleraction/input.js');

        $settings = $this->getSettings();

        $twig = $settings->postData;
        $twig .= '{{ data|json_encode|raw }}';

        $postData = craft()->templates->renderString($twig, array('object' => $this->element));
        $postData = json_decode($postData, true);

        return craft()->templates->render('controllerActionField/fieldtypes/controlleraction/input', array(
            'id'           => craft()->templates->formatInputId($name),
            'name'         => $name,
            'postData'     => $postData,
            'settings'     => $settings,
            'placeholders' => $this->getPlaceholderStrings(),
        ));
    }

    // Protected Methods
    // =========================================================================

    protected function getPlaceholderStrings()
    {
        return array(
            'buttonLabel'    => 'Action',
            'successMessage' => 'Action completed.',
            'errorMessage'   => 'Couldn’t complete action.',
        );
    }

    /**
     * Defines the settings.
     *
     * @return array
     */
    protected function defineSettings()
    {
        return array(
            'actionPath'     => array(AttributeType::String, 'required' => true),
            'postData'       => AttributeType::String,
            'buttonLabel'    => AttributeType::String,
            'successMessage' => AttributeType::String,
            'errorMessage'   => AttributeType::String,
        );
    }
}
