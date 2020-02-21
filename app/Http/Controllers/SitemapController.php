<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Sitemap\SitemapGenerator;

class SitemapController extends Controller
{
    function __invoke()
    {
        SitemapGenerator::create(env('APP_URL'))->writeToFile(public_path('sitemap.xml'));        
    }
}
