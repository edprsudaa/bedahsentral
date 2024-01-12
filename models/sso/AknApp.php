<?php

namespace app\models\sso;

use Yii;

/**
 * This is the model class for table "akn_app".
 *
 * @property int $id
 * @property string $nma
 * @property string|null $inf
 * @property string $prm
 * @property string|null $icn
 * @property string $lnk
 * @property string $kda
 * @property bool $sta
 * @property string $crd
 * @property string $mdd
 */
class AknApp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'akn_app';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_sso');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nma', 'prm', 'lnk', 'kda', 'sta', 'crd', 'mdd'], 'required'],
            [['inf', 'lnk'], 'string'],
            [['sta'], 'boolean'],
            [['crd', 'mdd'], 'safe'],
            [['nma', 'prm', 'icn'], 'string', 'max' => 64],
            [['kda'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nma' => 'Nma',
            'inf' => 'Inf',
            'prm' => 'Prm',
            'icn' => 'Icn',
            'lnk' => 'Lnk',
            'kda' => 'Kda',
            'sta' => 'Sta',
            'crd' => 'Crd',
            'mdd' => 'Mdd',
        ];
    }
}
