<?php

if (!function_exists('breadcrumb')) {
    function breadcrumb($content)
    {
        $nodes = Modules\Architect\Entities\Content::with('fields')->defaultOrder()->ancestorsAndSelf($content->id);
        $breadcrumb = [];
        $prefix = '';

        // Build breadcrumb path
        foreach($nodes as $node) {
            $prefix = $prefix . '/' . $node->getFieldValue('slug');
            array_push($breadcrumb,[
                'label' => $node->title,
                'url' => $prefix
            ]);
        }

        // Build HTML
        $html = '';
        foreach($breadcrumb as $k => $v) {
            $arrow = "";
            if($k != sizeof($breadcrumb)-1){
              $arrow = " > ";
            }

            $html .= sprintf('<a href="%s">%s</a>'.$arrow,
                $v['url'],
                $v['label']
            );
        }
        $html .= '';

        return $html;
    }

}
