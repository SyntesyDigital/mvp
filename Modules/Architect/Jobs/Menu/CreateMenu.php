<?php

namespace Modules\Architect\Jobs\Menu;

use Modules\Architect\Http\Requests\Menu\CreateMenuRequest;
use Modules\Architect\Entities\Menu;
use Modules\Architect\Entities\MenuElement;
use Modules\Architect\Entities\MenuElementField;
use Modules\Architect\Entities\Language;

class CreateMenu
{
    public function __construct($attributes)
    {
        $this->languages = Language::all();
        $this->attributes = array_only($attributes, [
            'name',
            'fields'
        ]);
    }

    public static function fromRequest(CreateMenuRequest $request)
    {
        return new self($request->all());
    }

    /*
    {
        'fields' : {
            'name' : {
                'es' : '....',
                'cat' : '....',
                'en' : '....',
            },
            'link' : {
                'es' : '....',
                'cat' : '....',
                'en' : '....',
            }
        }
    }
    */
    public function handle()
    {
        $this->menu = Menu::create([
            'name' => $this->attributes['name'] ? $this->attributes['name'] : null
        ]);

        foreach($this->attributes['fields'] as $name => $values) {

            $element = MenuElement::create([
                'menu_id' => $this->menu->id
            ]);

            $values = !is_array($values) ? [$values] : $values;

            switch($name) {
                case "name":
                    foreach($values as $iso => $value) {
                        $element->fields()->save(new MenuElementField([
                            'name' => $name,
                            'value' => $value,
                            'language_id' => Language::byIso($iso)->id
                        ]));
                    }
                break;

                case "link":
                    // Save father field
                    $field = MenuElementField::create([
                        'name' => $name,
                        'value' => '',
                        'menu_id' => $this->menu->id
                    ]);

                    // Save TITLE child fields
                    if(isset($values['title'])) {
                        foreach($values['title'] as $iso => $value) {
                            $element->fields()->save(new MenuElementField([
                                'name' => $name  . '.title',
                                'value' => $value,
                                'language_id' => Language::byIso($iso)->id,
                                'parent_id' => $field->id
                            ]));
                        }
                    }

                    // Save URL child fields
                    if(isset($values['url'])) {
                        foreach($values['url'] as $iso => $value) {
                            $element->fields()->save(new MenuElementField([
                                'name' => $name  . '.url',
                                'value' => $value,
                                'language_id' => Language::byIso($iso)->id,
                                'parent_id' => $field->id
                            ]));
                        }
                    }

                    // Save CONTENT child field
                    $contentId = (isset($values['content'])) && isset($values['content']['id'])
                        ? $values['content']['id']
                        : null;

                    if($contentId) {
                        $element->fields()->save(new MenuElementField([
                            'name' => $name  . '.content',
                            'value' => $contentId,
                            'language_id' => Language::byIso($iso)->id,
                            'parent_id' => $field->id,
                            'relations' => 'contents'
                        ]));
                    }
                break;
            }
        }
    }

}
