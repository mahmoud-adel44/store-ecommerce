<?php

use Illuminate\Support\Facades\App;

define('PAGINATION_COUNT', 15);

function getFolder(): string
{
    return app()->getLocale() === 'ar' ? 'css-rtl' : 'css';
}

function transwords($message)
{
    return Stichoza\GoogleTranslate\GoogleTranslate::trans($message, App::getLocale());
}

function uploadImage($folder, $image)
{
    $image->store('/', $folder);
    $filename = $image->hashName();
    return  $filename;
}
