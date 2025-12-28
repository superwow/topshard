<?php

namespace App\Controllers;

use App\Models\ServerModel;

class AddServerController extends BaseController
{
    public function index()
    {
        return view('pages/add', [
            'title' => 'Добавить сервер',
            'validation' => \Config\Services::validation(),
        ]);
    }

    public function store()
    {
        $serverModel = new ServerModel();

        $rules = [
            'name' => 'required|min_length[3]|max_length[255]',
            'game' => 'required|max_length[100]',
            'version' => 'permit_empty|max_length[100]',
            'type' => 'required|max_length[50]',
            'rates' => 'permit_empty|max_length[100]',
            'region' => 'permit_empty|max_length[100]',
            'language' => 'permit_empty|max_length[100]',
            'website_url' => 'permit_empty|valid_url_strict',
            'discord_url' => 'permit_empty|valid_url_strict',
            'forum_url' => 'permit_empty|valid_url_strict',
            'connect_host' => 'permit_empty|max_length[255]',
            'connect_port' => 'permit_empty|max_length[50]',
            'description' => 'permit_empty|max_length[2000]',
            'features' => 'permit_empty|max_length[2000]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $data = [
            'name' => trim((string) $this->request->getPost('name')),
            'game' => trim((string) $this->request->getPost('game')),
            'version' => trim((string) $this->request->getPost('version')),
            'type' => trim((string) $this->request->getPost('type')),
            'rates' => trim((string) $this->request->getPost('rates')),
            'region' => trim((string) $this->request->getPost('region')),
            'language' => trim((string) $this->request->getPost('language')),
            'website_url' => trim((string) $this->request->getPost('website_url')),
            'discord_url' => trim((string) $this->request->getPost('discord_url')),
            'forum_url' => trim((string) $this->request->getPost('forum_url')),
            'connect_host' => trim((string) $this->request->getPost('connect_host')),
            'connect_port' => trim((string) $this->request->getPost('connect_port')),
            'description' => trim((string) $this->request->getPost('description')),
            'features' => trim((string) $this->request->getPost('features')),
            'status' => 'pending',
        ];

        $data['slug'] = $this->generateUniqueSlug($data['name'], $serverModel);

        $serverModel->insert($data);

        return redirect()->to('/add')->with('success', 'Сервер отправлен на модерацию. Мы проверим его в ближайшее время.');
    }

    private function generateUniqueSlug(string $name, ServerModel $serverModel): string
    {
        $baseSlug = url_title($name, '-', true) ?: 'server';
        $slug = $baseSlug;
        $suffix = 1;

        while ($serverModel->where('slug', $slug)->countAllResults() > 0) {
            $slug = $baseSlug . '-' . $suffix;
            $suffix++;
        }

        return $slug;
    }
}
