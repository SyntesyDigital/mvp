<?php

if (!function_exists('display_menu')) {

    function display_menu($key)
    {
        $menu = Modules\Architect\Entities\Menu::hasName($key)->first();

        // $nodes = Modules\Architect\Entities\Content::with('fields')->ancestorsOf($content->id);
        // $breadcrumb = [];
        // $prefix = '';
        //
        // // Build breadcrumb path
        // foreach($nodes as $node) {
        //     $prefix = $prefix . '/' . $node->getFieldValue('slug');
        //     $breadcrumb[] = [
        //         'label' => $node->title,
        //         'url' => $prefix
        //     ];
        // }
        //
        // // Add current content
        // $prefix = $prefix . '/' . $content->getFieldValue('slug');
        // $breadcrumb[] = [
        //     'label' => $content->title,
        //     'url' => $prefix
        // ];
        //
        // // Build HTML
        // $html = '';
        // foreach($breadcrumb as $k => $v) {
        //
        //     $arrow = "";
        //     if($k != sizeof($breadcrumb)-1){
        //       $arrow = " > ";
        //     }
        //
        //     $html .= sprintf('<a href="%s">%s</a>'.$arrow,
        //         $v['url'],
        //         $v['label']
        //     );
        // }
        // $html .= '';
        //
        // return $html;
    }

}
