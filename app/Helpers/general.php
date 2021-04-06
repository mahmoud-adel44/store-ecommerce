<?php

define('PAGINATION_COUNT', 15);

function getFolder():string
{
    return app() ->getLocale() === 'ar' ? 'css-rtl' : 'css';

}

function transwords($message)
{
    return Stichoza\GoogleTranslate\GoogleTranslate::trans($message , App::getLocale());
}
