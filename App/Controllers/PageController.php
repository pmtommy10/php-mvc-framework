<?php

namespace App\Controllers;

use App\Core\Controller;

class PageController extends Controller
{
    static function index()
    {
        return self::createView('index', [
            'pageHeader' => [
                'pageTitle' => 'หน้าแรก',
                'pageDesc' => '',
                'url' => '/'
            ],
        ]);
    }
}