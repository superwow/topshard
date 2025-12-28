<?php

namespace App\Controllers;

use App\Models\ServerModel;
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

        return view('pages/servers', [
            'servers' => $servers,
            'pager' => $serverModel->pager,
            'filters' => $filters,
            'filterOptions' => (new ServerModel())->getFilterOptions(),
            'perPage' => $perPage,
        ]);
    }

    public function show(string $slug)
    {
        $serverModel = new ServerModel();
        $server = $serverModel->findPublicBySlug($slug);

        if (! $server) {
            throw PageNotFoundException::forPageNotFound("Server {$slug} not found");
        }

        return view('pages/server', [
            'server' => $server,
            'metricsPlaceholder' => true,
            'relatedServers' => (new ServerModel())->getRelatedServers($server),
        ]);
    }
}
