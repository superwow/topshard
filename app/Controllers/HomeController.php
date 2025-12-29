<?php

namespace App\Controllers;

use App\Models\ServerModel;
use App\Models\VoteModel;

class HomeController extends BaseController
{
    public function index()
    {
        $serverModel = new ServerModel();
        $activeServers = $serverModel->where('status', 'active')->findAll();
        $voteModel = new VoteModel();
        $stats = $voteModel->getStatsForServers(array_column($activeServers, 'id'));

        $scored = [];
        foreach ($activeServers as $server) {
            $serverStats = $stats[$server['id']] ?? ['total' => 0, 'votes_24h' => 0, 'votes_7d' => 0];
            $scored[] = array_merge($server, [
                'stats' => $serverStats,
                'rating' => $voteModel->calculateRating($serverStats),
                'trendScore' => $voteModel->calculateTrendScore($serverStats),
            ]);
        }

        $topServers = $scored;
        usort($topServers, static fn ($a, $b) => $b['rating'] <=> $a['rating']);
        $topServers = array_slice($topServers, 0, 5);

        $trendingServers = $scored;
        usort($trendingServers, static function ($a, $b) {
            $cmp = $b['trendScore'] <=> $a['trendScore'];

            if ($cmp === 0) {
                return $b['rating'] <=> $a['rating'];
            }

            return $cmp;
        });
        $trendingServers = array_slice($trendingServers, 0, 5);

        return view('pages/home', [
            'topServers' => $topServers,
            'trendingServers' => $trendingServers,
        ]);
    }
}
