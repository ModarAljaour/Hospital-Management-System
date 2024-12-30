<?php

namespace App\Services;

use jcobhams\NewsApi\NewsApi; // Import your News API class

class NewsService
{
    protected $newsApi;

    public function __construct()
    {
        $this->newsApi = new NewsApi(env('NEWS_API_KEY'));
    }

    public function getEverything($query, $from = null, $sortBy = 'popularity', $pageSize = 10, $page = 1)
    {
        return $this->newsApi->getEverything($query, null, null, null, $from, null, null, $sortBy, $pageSize, $page);
    }

    public function getTopHeadlines($query, $country = null, $category = null, $pageSize = 10, $page = 1)
    {
        return $this->newsApi->getTopHeadlines($query, null, $country, $category, $pageSize, $page);
    }

    public function getSources($category = null, $language = null, $country = null)
    {
        return $this->newsApi->getSources($category, $language, $country);
    }
}
