<?php

use yii\db\Migration;

/**
 * Class m240607_204941_add_foreign_keys_to_horario_materia_table
 */
class m240607_204941_add_foreign_keys_to_horario_materia_table extends Migration
{
   /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Añadir clave foránea para id_materia
        $this->addForeignKey(
            'fk-horario_materia-id_materia',  // Nombre de la clave foránea
            'horario_materia',                // Tabla actual
            'id_materia',                     // Columna actual
            'materia',                        // Tabla referenciada
            'id',                             // Columna referenciada
            'CASCADE'                         // Acción en DELETE
        );

        // Añadir clave foránea para id_reserva
        $this->addForeignKey(
            'fk-horario_materia-id_reserva',  // Nombre de la clave foránea
            'horario_materia',                // Tabla actual
            'id_reserva',                     // Columna actual
            'reserva_aula',                   // Tabla referenciada
            'id',                             // Columna referenciada
            'CASCADE'                         // Acción en DELETE
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Eliminar clave foránea para id_materia
        $this->dropForeignKey(
            'fk-horario_materia-id_materia',
            'horario_materia'
        );

        // Eliminar clave foránea para id_reserva
        $this->dropForeignKey(
            'fk-horario_materia-id_reserva',
            'horario_materia'
        );
    }
}
