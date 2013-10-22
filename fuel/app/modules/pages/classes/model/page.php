<?php

namespace Pages;

class Model_Page
{

    public static function load($shortCode=null)
    {
        if(!is_null($shortcode))
        {
            \DB::select("*")->from("pages");
        }
        else
        {
            throw new \Exception("No Page name given.");
        }
    }

}