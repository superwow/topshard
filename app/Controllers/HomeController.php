<?php

namespace App\Controllers;

use App\Models\ServerModel;

class HomeController extends BaseController
{
    public function index()
    {
        $serverModel = new ServerModel();
        $topServers = $serverModel->getTopServers(5);
        $trendingServers = $serverModel->getTrendingServers(5);

        return view('pages/home', [
            'topServers' => $topServers,
            'trendingServers' => $trendingServers,
        ]);
    }
}
