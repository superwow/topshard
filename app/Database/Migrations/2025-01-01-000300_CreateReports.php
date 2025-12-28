<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateReports extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'server_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'reason' => ['type' => 'VARCHAR', 'constraint' => 255],
            'message' => ['type' => 'TEXT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('server_id');
        $this->forge->createTable('reports');
    }

    public function down()
    {
        $this->forge->dropTable('reports');
    }
}
