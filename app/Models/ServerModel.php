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

    public function applyFilters(array $filters): self
    {
        $builder = $this->where('status', 'active');

        foreach (['game', 'type', 'rates', 'region', 'language'] as $key) {
            if (! empty($filters[$key])) {
                $builder = $builder->like($key, $filters[$key]);
            }
        }

        if (! empty($filters['q'])) {
            $builder = $builder->groupStart()
                ->like('name', $filters['q'])
                ->orLike('description', $filters['q'])
                ->orLike('game', $filters['q'])
                ->groupEnd();
        }

        $sort = $filters['sort'] ?? 'new';
        if ($sort === 'updated') {
            return $builder->orderBy('updated_at', 'DESC');
        }

        return $builder->orderBy('created_at', 'DESC');
    }

    public function getTopServers(int $limit = 5): array
    {
        return $this->where('status', 'active')
            ->orderBy('created_at', 'DESC')
            ->findAll($limit);
    }

    public function getTrendingServers(int $limit = 5): array
    {
        return $this->where('status', 'active')
            ->orderBy('updated_at', 'DESC')
            ->findAll($limit);
    }

    public function getFilterOptions(): array
    {
        $options = [];
        foreach (['game', 'type', 'region', 'language'] as $field) {
            $values = $this->select($field)
                ->distinct()
                ->where('status', 'active')
                ->orderBy($field, 'ASC')
                ->findColumn($field) ?? [];

            $options[$field] = array_values(array_filter($values, static fn ($value) => $value !== null && $value !== ''));
        }

        return $options;
    }

    public function findPublicBySlug(string $slug): ?array
    {
        return $this->where('slug', $slug)
            ->whereIn('status', ['active', 'pending'])
            ->first();
    }

    public function getRelatedServers(array $server, int $limit = 4): array
    {
        return $this->where('status', 'active')
            ->where('game', $server['game'])
            ->where('id !=', $server['id'])
            ->orderBy('created_at', 'DESC')
            ->findAll($limit);
    }
}
