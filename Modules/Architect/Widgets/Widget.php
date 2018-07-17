<?php

namespace Modules\Architect\Widgets;

use Modules\Architect\Widget\WidgetInterface;
use Modules\Architect\Entities\ContentField;
use Modules\Architect\Entities\Language;

abstract class Widget
{
    public function model()
    {
        return "Modules\\Architect\\Entities\\ContentField";
    }

    public function getLanguageFromIso($iso, $languages)
    {
        foreach($languages as $language) {
            if($language->iso == $iso) {
                return $language;
            }
        }
        return false;
    }

    public function save($content, $identifier, $fields)
    {
        foreach($fields as $field) {
            $fieldName = $identifier . "_" . $field['identifier'];
            $fieldValue = isset($field['value']) ? $field['value'] : null;
            (new $field['class'])->save($content, $fieldName, $fieldValue);
        }

        return true;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getIcon()
    {
        return $this->icon;
    }

    public function getRules()
    {
        return $this->rules;
    }

    public function getSettings()
    {
        return $this->settings;
    }

    public function getFields()
    {
        return $this->fields;
    }

    public function getComponent()
    {
        return $this->component;
    }


    public function getWidget()
    {
        return isset($this->widget) ? $this->widget : null;
    }
}
?>
