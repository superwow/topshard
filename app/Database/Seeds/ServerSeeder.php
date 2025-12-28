<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class ServerSeeder extends Seeder
{
    public function run()
    {
        $servers = [
            [
                'name' => 'Avalon L2',
                'slug' => 'avalon-l2',
                'game' => 'Lineage II',
                'version' => 'Interlude',
                'type' => 'pvp',
                'rates' => 'x50',
                'region' => 'EU',
                'language' => 'ru',
                'website_url' => 'https://avalon.example',
                'discord_url' => 'https://discord.gg/avalon',
                'forum_url' => null,
                'connect_host' => 'l2.avalon.example',
                'connect_port' => '2106',
                'description' => 'PvP сервер с классическими хрониками.',
                'features' => "Events every weekend\nNo pay-to-win\nActive moderation",
                'status' => 'active',
            ],
            [
                'name' => 'Rust Horizon',
                'slug' => 'rust-horizon',
                'game' => 'Rust',
                'version' => 'Latest',
                'type' => 'pvp',
                'rates' => '2x',
                'region' => 'NA',
                'language' => 'en',
                'website_url' => 'https://rust-horizon.example',
                'discord_url' => null,
                'forum_url' => null,
                'connect_host' => 'rust.horizon.example',
                'connect_port' => '28015',
                'description' => 'Vanilla-like Rust with quality-of-life tweaks.',
                'features' => "Weekly wipes\nActive admins\nNo cheaters",
                'status' => 'active',
            ],
            [
                'name' => 'MineWorld RP',
                'slug' => 'mineworld-rp',
                'game' => 'Minecraft',
                'version' => '1.20',
                'type' => 'rp',
                'rates' => null,
                'region' => 'EU',
                'language' => 'en',
                'website_url' => 'https://mineworld.example',
                'discord_url' => 'https://discord.gg/mineworld',
                'forum_url' => null,
                'connect_host' => 'play.mineworld.example',
                'connect_port' => '25565',
                'description' => 'Ролевой мир с проработанной экономикой.',
                'features' => "Seasons\nEconomy\nPlayer jobs",
                'status' => 'active',
            ],
            [
                'name' => 'WoW Legends',
                'slug' => 'wow-legends',
                'game' => 'World of Warcraft',
                'version' => 'WotLK',
                'type' => 'pve',
                'rates' => 'x5',
                'region' => 'EU',
                'language' => 'ru',
                'website_url' => 'https://wow-legends.example',
                'discord_url' => null,
                'forum_url' => 'https://forum.wow-legends.example',
                'connect_host' => null,
                'connect_port' => null,
                'description' => 'PVE сервера, френдли комьюнити.',
                'features' => "Blizzlike experience\nStable uptime\nFriendly staff",
                'status' => 'pending',
            ],
            [
                'name' => 'GTA V Drift City',
                'slug' => 'gta-v-drift-city',
                'game' => 'GTA V',
                'version' => 'FiveM',
                'type' => 'pvp',
                'rates' => null,
                'region' => 'NA',
                'language' => 'en',
                'website_url' => 'https://drift-city.example',
                'discord_url' => 'https://discord.gg/driftcity',
                'forum_url' => null,
                'connect_host' => 'drift.fivem.example',
                'connect_port' => '30120',
                'description' => 'Drift-focused FiveM server with weekly tournaments.',
                'features' => "Custom cars\nWeekly tournaments\nSkill-based rewards",
                'status' => 'active',
            ],
        ];

        $now = Time::now()->toDateTimeString();

        foreach ($servers as $server) {
            $server['created_at'] = $now;
            $server['updated_at'] = $now;
            $this->db->table('servers')->insert($server);
        }
    }
}
