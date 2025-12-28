<?php

namespace App\Controllers;

use App\Models\ServerModel;
use App\Models\VoteModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class ServerController extends BaseController
{
    public function index()
    {
        $serverModel = new ServerModel();
        $filters = [
            'game' => trim((string) $this->request->getGet('game')),
            'type' => trim((string) $this->request->getGet('type')),
            'rates' => trim((string) $this->request->getGet('rates')),
            'region' => trim((string) $this->request->getGet('region')),
            'language' => trim((string) $this->request->getGet('language')),
            'q' => trim((string) $this->request->getGet('q')),
            'sort' => $this->request->getGet('sort') ?: 'new',
        ];

        if (! in_array($filters['sort'], ['new', 'updated'], true)) {
            $filters['sort'] = 'new';
        }

        $perPage = 9;
        $servers = $serverModel->applyFilters($filters)->paginate($perPage);
        $voteCounts = (new VoteModel())->countForServers(array_column($servers, 'id'));

        return view('pages/servers', [
            'servers' => $servers,
            'pager' => $serverModel->pager,
            'filters' => $filters,
            'filterOptions' => (new ServerModel())->getFilterOptions(),
            'perPage' => $perPage,
            'voteCounts' => $voteCounts,
        ]);
    }

    public function show(string $slug)
    {
        $serverModel = new ServerModel();
        $server = $serverModel->findPublicBySlug($slug);

        if (! $server) {
            throw PageNotFoundException::forPageNotFound("Server {$slug} not found");
        }

        $voteModel = new VoteModel();
        $voterHash = $this->getVoterHash();
        $recentVote = $voteModel->getRecentVote((int) $server['id'], $voterHash, 24);
        $nextVoteAt = $recentVote ? $recentVote->addHours(24) : null;

        return view('pages/server', [
            'server' => $server,
            'metricsPlaceholder' => true,
            'relatedServers' => (new ServerModel())->getRelatedServers($server),
            'voteCount' => $voteModel->countForServer((int) $server['id']),
            'canVote' => $server['status'] === 'active' && $recentVote === null,
            'nextVoteAt' => $nextVoteAt,
        ]);
    }

    public function vote(string $slug)
    {
        $serverModel = new ServerModel();
        $server = $serverModel->where('slug', $slug)->where('status', 'active')->first();

        if (! $server) {
            return redirect()->back()->with('error', 'Сервер не найден или недоступен для голосования.');
        }

        $voterHash = $this->getVoterHash();
        $voteModel = new VoteModel();
        $recentVote = $voteModel->getRecentVote((int) $server['id'], $voterHash, 24);

        if ($recentVote) {
            $retryTime = $recentVote->addHours(24)->format('d.m.Y H:i');

            return redirect()->back()->with('error', "Можно голосовать раз в 24 часа. Следующий раз: {$retryTime}.");
        }

        $voteModel->insert([
            'server_id' => (int) $server['id'],
            'voter_hash' => $voterHash,
        ]);

        return redirect()->back()->with('success', 'Спасибо за голос! Возвращайтесь через 24 часа.');
    }

    private function getVoterHash(): string
    {
        $ip = (string) $this->request->getIPAddress();
        $agent = (string) $this->request->getUserAgent();

        return hash('sha256', $ip . '|' . $agent);
    }
}
