<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "aula".
 *
 * @property int $id
 * @property string $descripcion
 * @property string $ubicacion
 * @property int|null $cant_pcs
 * @property int|null $cant_proyector
 * @property bool|null $es_climatizada
 * @property int|null $aforo
 */
class Aula extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'aula';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion', 'ubicacion'], 'required'],
            [['cant_pcs', 'cant_proyector', 'aforo'], 'default', 'value' => null],
            [['cant_pcs', 'cant_proyector', 'aforo'], 'integer'],
            [['es_climatizada'], 'boolean'],
            [['descripcion', 'ubicacion'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descripcion' => 'Descripcion',
            'ubicacion' => 'Ubicacion',
            'cant_pcs' => 'Cant Pcs',
            'cant_proyector' => 'Cant Proyector',
            'es_climatizada' => 'Es Climatizada',
            'aforo' => 'Aforo',
        ];
    }

    /**
     * {@inheritdoc}
     * @return AulaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AulaQuery(get_called_class());
    }
}
