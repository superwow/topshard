<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateServers extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name' => ['type' => 'VARCHAR', 'constraint' => 255],
            'slug' => ['type' => 'VARCHAR', 'constraint' => 255, 'unique' => true],
            'game' => ['type' => 'VARCHAR', 'constraint' => 100],
            'version' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'type' => ['type' => 'VARCHAR', 'constraint' => 50],
            'rates' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'region' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'language' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'website_url' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'discord_url' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'forum_url' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'connect_host' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'connect_port' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'description' => ['type' => 'TEXT', 'null' => true],
            'features' => ['type' => 'TEXT', 'null' => true],
            'status' => ['type' => 'VARCHAR', 'constraint' => 50, 'default' => 'pending'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('servers');
    }

    public function down()
    {
        $this->forge->dropTable('servers');
    }
}
