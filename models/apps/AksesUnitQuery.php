<?php

namespace app\models\apps;

class AksesUnitQuery extends \yii\db\ActiveQuery
{
  public function deleted()
  {
    return $this->andWhere('deleted_at is not null');
  }
  // public function notDeleted()
  // {
  //   return $this->andWhere('deleted_at is null');
  // }
  public function active()
  {
    return $this->andWhere("aktif=1");
  }
  public function notActive()
  {
    return $this->andWhere("aktif=0");
  }
  public function init()
  {
    $this->andOnCondition(AksesUnit::tableName() . '.deleted_at is null');
    parent::init();
  }
  // public function all($db = null)
  // {
  //   return parent::all($db);
  // }
  // public function one($db = null)
  // {
  //   return parent::one($db);
  // }
}
