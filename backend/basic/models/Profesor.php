<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profesor".
 *
 * @property int $id
 * @property string $nombre
 * @property string $apellido
 * @property string $mostrar
 */
class Profesor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profesor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'apellido', 'mostrar'], 'required'],
            [['nombre', 'apellido', 'mostrar'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'mostrar' => 'Mostrar',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProfesorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProfesorQuery(get_called_class());
    }
}
