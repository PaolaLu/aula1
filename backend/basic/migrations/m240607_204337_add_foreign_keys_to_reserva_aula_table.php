<?php

use yii\db\Migration;

/**
 * Class m240607_204337_add_foreign_keys_to_reserva_aula_table
 */
class m240607_204337_add_foreign_keys_to_reserva_aula_table extends Migration
{
   /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Añadir la clave foránea
        $this->addForeignKey(
            'fk-reserva_aula-id_aula',  // Nombre de la clave foránea
            'reserva_aula',             // Tabla actual
            'id_aula',                  // Columna actual
            'aula',                     // Tabla referenciada
            'id',                       // Columna referenciada
            'CASCADE'                   // Acción en DELETE
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Eliminar la clave foránea
        $this->dropForeignKey(
            'fk-reserva_aula-id_aula',
            'reserva_aula'
        );
    }
}
