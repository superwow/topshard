<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateVotes extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'server_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'voter_hash' => ['type' => 'VARCHAR', 'constraint' => 255],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('server_id');
        $this->forge->addKey('voter_hash');
        $this->forge->createTable('votes');
    }

    public function down()
    {
        $this->forge->dropTable('votes');
    }
}
