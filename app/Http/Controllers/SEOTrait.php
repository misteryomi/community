<?php

namespace App\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOTools;

trait SEOTrait {


    public function setSEO($title, $description, $url, $propertyType = 'article', $site='@411ng_',  $canonical = null, $image = null) {
        SEOTools::setTitle($title);
        SEOTools::setDescription($description);
        SEOTools::opengraph()->setUrl($url);
        // SEOTools::setCanonical($canonical);
        SEOTools::opengraph()->addProperty('type', $propertyType);
        SEOTools::twitter()->setSite($site);
        if($image) {
            SEOTools::jsonLd()->addImage($image);
        }
    }
}