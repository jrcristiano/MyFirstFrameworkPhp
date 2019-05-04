<?php

namespace Core;

class View
{
    public function __construct($template, $page, $data)
    {
        $hasFile = function ($file) {
            $file = __DIR__."/../app/Views/{$file}.tpl.php";
            return file_exists($file);
        };

        if ($hasFile($template) && $hasFile($page)) {
            $data = $data;
            $page = __DIR__."/../app/Views/{$page}.tpl.php";
            include_once __DIR__."/../app/Views/{$template}.tpl.php";
        }
        
    }
}
