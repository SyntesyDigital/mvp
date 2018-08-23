<?php

namespace Modules\Architect\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

use DataTables;
use Storage;

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

    public function getDatatable($options = [])
    {
        return Datatables::of(Menu::all())
            ->addColumn('action', function ($item) {
                return '
                <a href="'.route('menu.show',$item).'" class="btn btn-link toogle-edit" data-toogle="edit" data-id="'.$item->id.'"><i class="fa fa-pencil"></i> Editar</a> &nbsp;
                <a href="#" class="btn btn-link text-danger" data-toogle="delete" data-ajax="' . route('menu.delete', $item) . '" data-confirm-message="Estàs segur ?"><i class="fa fa-trash"></i> Esborrar</a> &nbsp;
                ';
            })
            ->make(true);
    }

    /*
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
    */

    public function getElementTree()
  	{

  		$menuElementsTree = array();
      $languages = Language::all();
  		$level = 1;

  		$traverse = function (&$menuElementsTree,$menuElements,$level) use (&$traverse,$languages) {

  			  $level++;

          foreach ($menuElements as $menuElement) {

            $field = [
              "id" => $menuElement->id,
              "identifier" => "link",
              "value" => $menuElement->getFieldValues('link','link',$languages),
              "name" => "Enllaç"
            ];

      			array_push($menuElementsTree,array(
      				"name" => $menuElement->getFieldValue('link.title'),
      				"id" => $menuElement->id,
      				"parent_id" => $menuElement->parent_id,
      				"order" => $menuElement->order,
      				"level" => $level,
              "field" => $field,
      			));

            $traverse($menuElementsTree,$menuElement->children,$level);
          }
      };

      $menuElements = MenuElement::orderBy('order','ASC')->get();

  		foreach($menuElements as $menuElement) {

  			if(!$menuElement->parent_id) {

          $field = [
            "id" => $menuElement->id,
            "identifier" => "link",
            "value" => $menuElement->getFieldValues('link','link',$languages),
            "name" => "Enllaç"
          ];

  				array_push($menuElementsTree,array(
						//"name" => $menuElement->getFieldValue('title'),
            "name" => $menuElement->getFieldValue('link.title'),
						"id" => $menuElement->id,
						"parent_id" => $menuElement->parent_id,
						"order" => $menuElement->order,
						"level" => $level,
            "field" => $field,
					));

  				//all parents
          $traverse($menuElementsTree,MenuElement::getTree($menuElement->id), $level);
        }
      }

      return  $menuElementsTree;

    }


}