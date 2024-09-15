<?php

class m200721_025446_init_tabel_barang_struktur extends CDbMigration
{

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4';

        $this->createTable('barang_struktur',
                ["
              `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
              `parent_id` int(10) unsigned DEFAULT NULL,
              `kode` varchar(128) DEFAULT NULL,
              `nama` varchar(128) NOT NULL,
              `level` tinyint(4) NOT NULL DEFAULT '1',
              `urutan` tinyint(1) NOT NULL DEFAULT '0',
              `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=not publish; 1=publish; 2=reserved',
              `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
              `updated_by` int(10) unsigned NOT NULL,
              `created_at` timestamp NOT NULL DEFAULT '2000-01-01 00:00:00',
              PRIMARY KEY (`id`),
              KEY `fk_barang_struktur_updatedby_idx` (`updated_by`),
              KEY `fk_barang_struktur_parent_idx` (`parent_id`),
              KEY `nama_barang_struktur_idx` (`nama`),
              CONSTRAINT `fk_barang_struktur_parent` FOREIGN KEY (`parent_id`) REFERENCES `barang_struktur` (`id`),
              CONSTRAINT `fk_barang_struktur_updatedby` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`)"
                ], $tableOptions);

        $now = date('Y-m-d H:i:s');
        $this->insertMultiple('barang_struktur', [
            ['nama' => 'rc1', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc2', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc3', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc4', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc5', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc6', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc7', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc8', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc9', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc10', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc11', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc12', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc13', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc14', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc15', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc16', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc17', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc18', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc19', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc20', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc21', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc22', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc23', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc24', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc25', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc26', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc27', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc28', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc29', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc30', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc31', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc32', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc33', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc34', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc35', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc36', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc37', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc38', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc39', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc40', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc41', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc42', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc43', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc44', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc45', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc46', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc47', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc48', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc49', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc50', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc51', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc52', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc53', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc54', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc55', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc56', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc57', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc58', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc59', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc60', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc61', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc62', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc63', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc64', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc65', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc66', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc67', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc68', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc69', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc70', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc71', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc72', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc73', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc74', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc75', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc76', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc77', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc78', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc79', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc80', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc81', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc82', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc83', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc84', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc85', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc86', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc87', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc88', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc89', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc90', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc91', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc92', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc93', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc94', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc95', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc96', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc97', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc98', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc99', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
            ['nama' => 'rc100', 'status' => 2, 'updated_by' => 1, 'created_at' => $now],
        ]);
    }

    public function safeDown()
    {
        echo "m200721_025446_init_tabel_barang_struktur does not support migration down.\n";
        return false;
    }

}
