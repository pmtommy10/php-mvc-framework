<?php

namespace App\Core;

use App\Controllers\HomeController;
use App\Models\ProductCategory;
use App\Models\Shop;

class Controller
{

    public static $view;
    public static $data;

    static function createView(string $viewName = null, array $data = null, string $templateName = "template")
    {
        self::$view = self::$view ?? $viewName . '.php';
        self::$data = self::$data ?? $data;
        extract(self::$data);
        return require_once VIEWS . DS . "templates" . DS . "{$templateName}.php";
    }

    static function requireView(string $fileFullPath, array $data = null)
    {
        self::$data = self::$data ?? $data;
        extract(self::$data);
        require_once VIEWS . DS . $fileFullPath;
    }

    static function paginate(int $total, int $itemsPerPage, string $variableName = 'pageNo')
    {
        $pages = new Paginator($itemsPerPage, $variableName);
        $pages->set_total($total);
        return $pages->page_links();
    }

    static function outputError(Object $exception, array $errors = [])
    {
        $output = [
            'success' => false,
            'text' => $exception->getMessage(),
            'postData' => $_POST,
        ];
        if (ENV === 'dev') {
            $output['line'] = $exception->getLine();
            $output['errors'] = $errors;
            $output['trace'] = $exception->getTrace();
            $output['prev'] = $exception->getPrevious();
        }
        return $output;
    }

    static function notFound()
    {
        self::createView('404', [
            'pageHeader' => [
                'pageTitle' => '404 ไม่พบหน้าที่ต้องการ',
                'pageDesc' => '',
                'url' => '404.php'
            ],
        ]);
    }

}
