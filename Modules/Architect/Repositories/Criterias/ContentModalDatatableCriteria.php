<?php

namespace Modules\Architect\Repositories\Criterias;

use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Contracts\CriteriaInterface;

class ContentModalDatatableCriteria implements CriteriaInterface
{

    public function apply($model, RepositoryInterface $repository)
    {
        $acceptLang = request('accept_lang');
        $typologyId = request('typology_id') ? json_decode(request('typology_id'), true) : null;
        $categoryId = request('category_id') ? json_decode(request('category_id'), true) : null;
        $tags = request('tags') ? json_decode(request('tags'), true) : null;
        $fields = request('fields') ? json_decode(request('fields')) : null;

        return $model
            ->languageIso($acceptLang)
            ->typologyId($typologyId)
            ->categoryId($categoryId)
            ->byTagsIds($tags)
            ->whereFields($fields);
    }
}
