<?php

namespace Modules\Architect\Repositories\Criterias;

use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Contracts\CriteriaInterface;

class ModalDatatableCriteria implements CriteriaInterface {

    public function apply($model, RepositoryInterface $repository)
    {
        $request = request();
        $acceptLang = $request->get('accept_lang');
        $typologyId = $request->get('typology_id') ? json_decode($request->get('typology_id'), true) : null;
        $categoryId = $request->get('category_id') ? json_decode($request->get('category_id'), true) : null;
        $tags = $request->get('tags') ? json_decode($request->get('tags'), true) : null;
        $fields = $request->get('fields') ? json_decode($request->get('fields')) : null;

        return $model
            ->languageIso($acceptLang)
            ->typologyId($typologyId)
            ->categoryId($categoryId)
            ->byTagsIds($tags)
            ->whereFields($fields);
    }
}
