<?php


function getFolder():string
{
    return app() ->getLocale() === 'ar' ? 'css-rtl' : 'css';

}
