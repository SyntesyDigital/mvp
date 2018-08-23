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
         $this->menu = $menu;
         $this->attributes = array_only($attributes, [
             'name',
             'fields'
         ]);
         $this->languages = Language::all()->pluck('id','iso');
     }

    public static function fromRequest(Menu $menu, CreateMenuRequest $request)
    {
        return new self($menu, $request->all());
    }

    private function saveField($field,$order,$parent_id)
    {
        $name = "link";
        $values = $field["value"];

        // Save father field
        $menuField = MenuElement::create([
            'menu_id' => $this->menu->id,
            'parent_id' => $parent_id,
            'order' => $order
        ]);

        $menuElementField = $menuField->fields()->save(new MenuElementField([
            'name' => $name,
            'value' => '',
        ]));

        // Save TITLE child fields
        if(isset($values['title'])) {
            foreach($values['title'] as $iso => $value) {

                $menuField->fields()->save(new MenuElementField([
                    'name' => $name  . '.title',
                    'value' => $value,
                    'language_id' => $this->languages[$iso],
                    'parent_id' => $menuElementField->id
                ]));
            }
        }

        // Save URL child fields
        if(isset($values['url'])) {
            foreach($values['url'] as $iso => $value) {
                $menuField->fields()->save(new MenuElementField([
                    'name' => $name  . '.url',
                    'value' => $value,
                    'language_id' => $this->languages[$iso],
                    'parent_id' => $menuElementField->id
                ]));
            }
        }

        // Save CONTENT child field
        $contentId = (isset($values['content'])) && isset($values['content']['id'])
            ? $values['content']['id']
            : null;

        if($contentId) {
            $menuField->fields()->save(new MenuElementField([
                'name' => $name  . '.content',
                'value' => $contentId,
                'parent_id' => $menuElementField->id,
                'relations' => 'contents'
            ]));
        }

        $menuField->parent_id = $parent_id;
        $menuField->save();

        return $menuField;
    }

    public function handle()
    {

        $fields = $this->attributes['fields'];
        $order = 1;

        $this->menu->update([
            'name' => $this->attributes['name'] ? $this->attributes['name'] : null
        ]);

        //return true;

        $this->menu->elements()->delete();

        $traverse = function ($parent_id,$children) use (&$traverse) {

    				$order = 1;

    				foreach ($children as $menuItem) {

    					$field = json_decode($menuItem['field'],true);
              $menuField = $this->saveField($field,$order,$parent_id);

    					$order++;

    					if(isset($menuItem['children'])){
    						$children = $menuItem['children'][0];

    						$traverse($menuField->id,$children);
    					}
            }
    	  };

        $traverse(null,$fields[0]);

        return true;

/*
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

        */

    }
}
