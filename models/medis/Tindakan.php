<?php

namespace app\models\medis;

use Yii;

/**
 * This is the model class for table "medis.tindakan".
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string $deskripsi
 * @property int|null $aktif
 * @property string|null $kode_jenis
 * @property string|null $created_at
 * @property int $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 * @property int|null $is_deleted
 */
class Tindakan extends \yii\db\ActiveRecord
{
  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
    return 'medis.tindakan';
  }

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['parent_id', 'aktif', 'created_by', 'updated_by', 'is_deleted', 'jenis_tindakan'], 'default', 'value' => null],
      [['parent_id', 'aktif', 'created_by', 'updated_by', 'is_deleted', 'jenis_tindakan'], 'integer'],
      [['deskripsi', 'created_by'], 'required'],
      [['deskripsi'], 'string'],
      [['created_at', 'updated_at'], 'safe'],
      [['kode_jenis'], 'string', 'max' => 255],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels()
  {
    return [
      'id' => 'ID',
      'parent_id' => 'Parent ID',
      'deskripsi' => 'Deskripsi',
      'aktif' => 'Aktif',
      'kode_jenis' => 'Kode Jenis',
      'created_at' => 'Created At',
      'created_by' => 'Created By',
      'updated_at' => 'Updated At',
      'updated_by' => 'Updated By',
      'is_deleted' => 'Is Deleted',
      'jenis_tindakan' => 'Jenis Tindakan'
    ];
  }

  /**
   * {@inheritdoc}
   * @return TindakanQuery the active query used by this AR class.
   */
  public static function find()
  {
    return new TindakanQuery(get_called_class());
  }
  public static function getListTindakan($q = null)
  {
    // reff : https://gist.github.com/dankrause/76baa0ad73ff19fd39e861600c56a15d
    $sql = "
        WITH RECURSIVE parents AS
        (
            SELECT
                id              AS id,
                0               AS number_of_ancestors,
                ARRAY [id]      AS ancestry,
                NULL :: BIGINT  AS parent,
                id              AS start_of_ancestry,
                deskripsi 		AS rumpun,
                kode_jenis,
                deskripsi,
                aktif,
                is_deleted
            FROM " . self::tableName() . "
            WHERE
                parent_id IS NULL AND aktif=1 AND is_deleted IS NULL
            UNION ALL
            SELECT
                child.id                                       AS id,
                p.number_of_ancestors + 1                      AS ancestry_size,
                array_append(p.ancestry, child.id)             AS ancestry,
                child.parent_id                                AS parent,
                coalesce(p.start_of_ancestry, child.parent_id) AS start_of_ancestry,
                p.rumpun || ' -> ' || child.deskripsi          AS rumpun,
                child.kode_jenis,
                child.deskripsi,
                child.aktif,
                child.is_deleted
            FROM " . self::tableName() . " child
                INNER JOIN parents p ON p.id = child.parent_id
        )
        select
            id as id ,CONCAT('(',kode_jenis,') ',deskripsi) as text, rumpun,CONCAT('(',rumpun,')',deskripsi) as text_rumpun,kode_jenis,deskripsi
        FROM parents icd  where icd.id not in (select distinct parent from parents where parent is not null) AND (LOWER(kode_jenis) ilike '%" . strtolower($q) . "%' OR LOWER(deskripsi) ilike '%" . strtolower($q) . "%')
        ";
    return Yii::$app->db->createCommand($sql)->queryAll();
  }
}
