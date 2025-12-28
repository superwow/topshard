<?php

namespace App\Models;

use CodeIgniter\Model;

class ServerModel extends Model
{
    protected $table = 'servers';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name',
        'slug',
        'game',
        'version',
        'type',
        'rates',
        'region',
        'language',
        'website_url',
        'discord_url',
        'forum_url',
        'connect_host',
        'connect_port',
        'description',
        'features',
        'status',
    ];

    protected $useTimestamps = true;

    public function filterActive(array $filters): self
    {
        $builder = $this->where('status', 'active');

        foreach (['game', 'type', 'rates', 'region'] as $key) {
            if (! empty($filters[$key])) {
                $builder = $builder->where($key, $filters[$key]);
            }
        }

        return $builder->orderBy('created_at', 'DESC');
    }

    public function getTopServers(int $limit = 5): array
    {
        return $this->where('status', 'active')
            ->orderBy('created_at', 'DESC')
            ->limit($limit)
            ->find();
    }

    public function getTrendingServers(int $limit = 5): array
    {
        return $this->where('status', 'active')
            ->orderBy('updated_at', 'DESC')
            ->limit($limit)
            ->find();
    }
}
