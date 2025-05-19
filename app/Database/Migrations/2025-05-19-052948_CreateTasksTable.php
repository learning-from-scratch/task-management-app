<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTasksTable extends Migration
{
   public function up()
   {
      $this->forge->addField([
         'id'          => ['type' => 'INT', 'auto_increment' => true],
         'title'       => ['type' => 'VARCHAR', 'constraint' => 150],
         'description' => ['type' => 'TEXT', 'null' => true],
         'priority'    => ['type' => 'ENUM', 'constraint' => ['Low', 'Medium', 'High'], 'default' => 'Low'],
         'status'      => ['type' => 'ENUM', 'constraint' => ['Pending', 'In Progress', 'Completed'], 'default' => 'Pending'],
         'due_date'    => ['type' => 'DATE', 'null' => true],
         'created_at' => ['type' => 'DATETIME', 'null' => true],
         'updated_at'  => ['type' => 'DATETIME', 'null' => true],
      ]);
      $this->forge->addKey('id', true);
      $this->forge->createTable('tasks');
   }

   public function down()
   {
      $this->forge->dropTable('tasks');
   }
}
