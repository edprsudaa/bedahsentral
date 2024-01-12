<?php

namespace app\models\apps;

use Yii;

/**
 * This is the model class for table "master_aplikasi".
 *
 * @property string $id_aplikasi
 * @property string $icon
 * @property string $nama
 * @property string $deskripsi
 * @property string $url
 * @property int $is_active
 * @property int $created_by
 * @property string $created_at
 * @property int|null $updated_by
 * @property string|null $updated_at
 * @property int|null $deleted_by
 * @property string|null $deleted_at
 */
class MasterAplikasi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'master_aplikasi';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_apps');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_aplikasi', 'icon', 'nama', 'deskripsi', 'url', 'created_by', 'created_at'], 'required'],
            [['icon', 'nama', 'deskripsi', 'url'], 'string'],
            [['is_active', 'created_by', 'updated_by', 'deleted_by'], 'default', 'value' => null],
            [['is_active', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['id_aplikasi'], 'string', 'max' => 255],
            [['id_aplikasi'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_aplikasi' => 'Id Aplikasi',
            'icon' => 'Icon',
            'nama' => 'Nama',
            'deskripsi' => 'Deskripsi',
            'url' => 'Url',
            'is_active' => 'Is Active',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'deleted_by' => 'Deleted By',
            'deleted_at' => 'Deleted At',
        ];
    }
}
