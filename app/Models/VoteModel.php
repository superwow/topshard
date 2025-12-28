<?php

namespace App\Models;

use CodeIgniter\I18n\Time;
use CodeIgniter\Model;

class VoteModel extends Model
{
    protected $table = 'votes';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'server_id',
        'voter_hash',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = '';

    public function countForServer(int $serverId): int
    {
        return $this->where('server_id', $serverId)->countAllResults();
    }

    public function countForServers(array $serverIds): array
    {
        if ($serverIds === []) {
            return [];
        }

        $rows = $this->select('server_id, COUNT(*) as votes')
            ->whereIn('server_id', $serverIds)
            ->groupBy('server_id')
            ->findAll();

        $result = [];
        foreach ($rows as $row) {
            $result[(int) $row['server_id']] = (int) $row['votes'];
        }

        return $result;
    }

    public function getLastVoteTime(int $serverId, string $voterHash): ?Time
    {
        $row = $this->select('created_at')
            ->where('server_id', $serverId)
            ->where('voter_hash', $voterHash)
            ->orderBy('created_at', 'DESC')
            ->first();

        if (! $row || empty($row['created_at'])) {
            return null;
        }

        return Time::parse($row['created_at']);
    }

    public function getRecentVote(int $serverId, string $voterHash, int $cooldownHours): ?Time
    {
        $lastVote = $this->getLastVoteTime($serverId, $voterHash);

        if ($lastVote === null) {
            return null;
        }

        $cooldownStart = Time::now()->subHours($cooldownHours);

        return $lastVote->isAfter($cooldownStart) ? $lastVote : null;
    }
}
