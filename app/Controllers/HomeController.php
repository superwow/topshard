<?php

namespace App\Controllers;

use App\Models\ServerModel;
use App\Models\VoteModel;

class HomeController extends BaseController
{
    public function index()
    {
        $serverModel = new ServerModel();
        $topServers = $serverModel->getTopServers(5);
        $trendingServers = $serverModel->getTrendingServers(5);
        $voteModel = new VoteModel();
        $voteCounts = $voteModel->countForServers(array_unique(array_merge(
            array_column($topServers, 'id'),
            array_column($trendingServers, 'id')
        )));

        return view('pages/home', [
            'topServers' => $topServers,
            'trendingServers' => $trendingServers,
            'voteCounts' => $voteCounts,
        ]);
    }
}
