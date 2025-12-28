<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMetricsDaily extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'server_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'date' => ['type' => 'DATE'],
            'online_avg' => ['type' => 'INT', 'null' => true],
            'online_peak' => ['type' => 'INT', 'null' => true],
            'uptime_percent' => ['type' => 'DECIMAL', 'constraint' => '5,2', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey(['server_id', 'date'], false, true);
        $this->forge->createTable('metrics_daily');
    }

    public function down()
    {
        $this->forge->dropTable('metrics_daily');
    }
}
