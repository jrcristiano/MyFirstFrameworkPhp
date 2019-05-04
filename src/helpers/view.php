<?php

function view(array $view)
{   
    $template = $view['view'][0];
    $page = $view['view'][1];
    $data = $view['data'];

    return new Core\View($template, $page, $data);
}
