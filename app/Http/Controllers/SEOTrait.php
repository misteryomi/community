<?php

namespace App\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOTools;

trait SEOTrait {


    public function setSEO($title, $description, $url, $image = null, $propertyType = 'article', $site='@jaracentralHQ',  $canonical = null ) {
        SEOTools::setTitle($title);
        SEOTools::setDescription($description);
        SEOTools::opengraph()->setUrl($url);
        // SEOTools::setCanonical($canonical);
        SEOTools::opengraph()->addProperty('type', $propertyType);
        SEOTools::twitter()->setSite($site);
        if($image) {
            SEOTools::jsonLd()->addImage($image);
            SEOTools::opengraph()->addImage($image);
            SEOTools::twitter()->addImage($image);
            // OpenGraph::addImage($post->cover->url);

        }
    }
}