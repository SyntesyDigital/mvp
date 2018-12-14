<?php

if (!function_exists('breadcrumb')) {


    function page_breadcrumb($content)
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
        $html = '<ol class="breadcrumb">';

        foreach($breadcrumb as $k => $v) {
            $html .= sprintf('<li><a href="%s">%s</a></li>',
                $v['url'],
                $v['label']
            );
        }
        $html .= '</ol>';

        return $html;
    }

    function typology_breadcrumb($content)
    {

        $breadcrumb = [];
        $prefix = '';

        $blog = Modules\Architect\Entities\Content::whereField("slug","blog")->first();

        array_push($breadcrumb,[
            'label' => $blog->title,
            'url' => $blog->url
        ]);

        $category = $content->categories->first();
        if($category != null){
          array_push($breadcrumb,[
              'label' => $category->getFieldValue('name'),
              'url' => route('blog.category.index' , $category->getFieldValue('slug'))
          ]);
        }

        array_push($breadcrumb,[
            'label' => $content->title,
            'url' => $content->url
        ]);

        // Build HTML
        $html = '<ol class="breadcrumb">';
        foreach($breadcrumb as $k => $v) {

            $html .= sprintf('<li><a href="%s">%s</a></li>',
                $v['url'],
                $v['label']
            );
        }
        $html .= '</ol>';

        return $html;
    }

    function breadcrumb_category($category)
    {
        $breadcrumb = [];
        $prefix = '';

        $blog = Modules\Architect\Entities\Content::whereField("slug","blog")->first();

        array_push($breadcrumb,[
            'label' => $blog->title,
            'url' => $blog->url
        ]);

        array_push($breadcrumb,[
            'label' => $category->getFieldValue('name'),
            'url' => route('blog.category.index' , $category->getFieldValue('slug'))
        ]);

        // Build HTML
        $html = '<ol class="breadcrumb">';
        foreach($breadcrumb as $k => $v) {
            $arrow = "";
            if($k != sizeof($breadcrumb)-1){
              $arrow = " > ";
            }

            $html .= sprintf('<li><a href="%s">%s</a></li>',
                $v['url'],
                $v['label']
            );
        }
        $html .= '</ol>';

        return $html;
    }

    function breadcrumb($content)
    {
        if($content->is_page){
          return page_breadcrumb($content);
        }
        else {
          return typology_breadcrumb($content);
        }
    }

}
