<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Komik extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'judul' => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
			'slug' => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
			'penulis' => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
			'penerbit' => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
			'sampul' => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
			'created_at' => [
				'type' => 'DATETIME',
				'null' => TRUE
			],
			'updated_at' => [
				'type' => 'DATETIME',
				'null' => TRUE
			]

		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('komik');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('komik');
	}
}
