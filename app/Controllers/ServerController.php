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
            'game' => $this->request->getGet('game'),
            'type' => $this->request->getGet('type'),
            'rates' => $this->request->getGet('rates'),
            'region' => $this->request->getGet('region'),
        ];

        $servers = $serverModel->filterActive($filters)->paginate(10);

        return view('pages/servers', [
            'servers' => $servers,
            'pager' => $serverModel->pager,
            'filters' => $filters,
        ]);
    }

    public function show(string $slug)
    {
        $serverModel = new ServerModel();
        $server = $serverModel->where('slug', $slug)->first();

        if (! $server) {
            throw PageNotFoundException::forPageNotFound("Server {$slug} not found");
        }

        return view('pages/server', [
            'server' => $server,
            'metricsPlaceholder' => true,
        ]);
    }
}
