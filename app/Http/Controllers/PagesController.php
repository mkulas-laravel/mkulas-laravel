<?php

namespace App\Http\Controllers;

use App\Models\GetDataGuzzle;
use Carbon\Carbon;

class PagesController extends Controller
{
    private GetDataGuzzle $getDataGuzzle;

    public function __construct(GetDataGuzzle $getDataGuzzle)
    {
        $this->getDataGuzzle = $getDataGuzzle;
    }

    public function home()
    {
        return view('home');
    }

    public function faq()
    {
        return view('faq');
    }

    public function namedays()
    {
        return view('namedays', [
            'posts' => $this->getDataGuzzle->getNameday(),
            'dayname' => Carbon::now()->locale('sk')->dayName
        ]);
    }

    public function show($id)
    {
        return view('show', [
            'posts' => $this->getDataGuzzle->getNameday($id),
        ]);

    }
}
