<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Service\PostService;

class BaseController extends Controller
{

 public $service;

    /**
     * @param $service
     */
    public function __construct(PostService $service)
    {
        $this->service = $service;
    }

}
