<?php

use yii\db\Migration;

/**
 * Class m240607_203011_add_foreign_keys_to_materia_table
 */
class m240607_203011_add_foreign_keys_to_materia_table extends Migration
{
 /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Añadir claves foráneas
        $this->addForeignKey(
            'fk-materia-id_carrera',
            'materia',
            'id_carrera',
            'carrera',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-materia-id_profesor',
            'materia',
            'id_profesor',
            'profesor',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Eliminar claves foráneas
        $this->dropForeignKey(
            'fk-materia-id_carrera',
            'materia'
        );

        $this->dropForeignKey(
            'fk-materia-id_profesor',
            'materia'
        );
    }
}
