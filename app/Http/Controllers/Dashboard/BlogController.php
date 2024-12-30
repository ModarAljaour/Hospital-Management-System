<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\NewsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BlogController extends Controller
{

    protected $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }


    public function index(Request $request)
    {
        $articles = $this->newsService->getEverything('health', now()->subDay()->toDateString());
        return view('WebSite.layouts.blog2', compact('articles'));
    }



    public function getDrugData()
    {
        $apiKey = env('NEWS_API_KEY');


        $response = Http::get('https://newsapi.org/v2/everything', [
            'q' => "Health",
            'from' => now()->subDay()->toDateString(),
            'sortBy' => 'popularity',
            'apiKey' => $apiKey // تمرير مفتاح AP
        ]);


        if ($response->successful()) {
            $data = $response->json();
            return view('WebSite.layouts.blog', ['articles' => $data['articles']]);
        } else {
            return response()->json(['error' => 'Unable to fetch news'], 500);
        }


        // $response = Http::get('https://api.fda.gov/drug/label.json');

        // if ($response->successful()) {
        //     $data = $response->json('results');

        //     return view("WebSite.layouts.blog", ['data' => $data]);
        // } else {
        //     return response()->json(['error' => 'Unable to fetch data'], 500);
        // }
    }
}
