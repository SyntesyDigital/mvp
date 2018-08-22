<?php

namespace Modules\Architect\Jobs\Menu;

use Modules\Architect\Http\Requests\Menu\CreateMenuRequest;

use Modules\Architect\Entities\Menu;
use Modules\Architect\Entities\MenuElement;
use Modules\Architect\Entities\MenuElementField;
use Modules\Architect\Entities\Language;

class UpdateMenu
{
     public function __construct(Menu $menu, $attributes)
     {
         $this->menu = $Menu;
         $this->attributes = array_only($attributes, [
             'name',
             'fields'
         ]);
     }

    public static function fromRequest(Menu $menu, CreateMenuRequest $request)
    {
        return new self($menu, $request->all());
    }

    public function handle()
    {
        $this->menu->update([
            'name' => $this->attributes['name'] ? $this->attributes['name'] : null
        ]);

        $this->menu->elements()->delete();

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
