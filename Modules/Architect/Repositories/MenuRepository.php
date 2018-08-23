<?php

namespace Modules\Architect\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

use Modules\Architect\Entities\Menu;
use Modules\Architect\Entities\MenuElement;
use Modules\Architect\Entities\MenuElementField;
use Modules\Architect\Entities\Language;

class MenuRepository extends BaseRepository
{
    public function model()
    {
        return "Modules\\Architect\\Entities\\Menu";
    }

    public function getElementTree()
    {
        $nodes = MenuElement::get()->toTree();
        $languages = Language::all();
        $tree = [];

        $traverse = function ($elements) use (&$traverse, $languages) {
            $tree = [];
            foreach ($elements as $element) {
                $tree[] = [
                    "id" => $element->id,
                    "link" => $element->getFieldValues('link', 'link', $languages),
                    "name" =>  $element->getFieldValues('name', 'text', $languages),
                    "childrens" => $element->children ? $traverse($element->children) : null,
                ];
            }

            return $tree;
        };

        return $traverse($nodes);
    }

    public function getElement($id)
    {
        return MenuElement::find($id);
    }
}
