<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Api\Repositories\TagRepository;

class TagController extends Controller
{

    public function __construct(TagRepository $tags)
    {
        $this->tags = $tags;
    }

    public function index()
    {
        return $this->tags->fetchAll();
    }

}
