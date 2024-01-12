<?php
namespace app\models\other;
use Yii;
class BaseQuery extends \yii\db\ActiveQuery
{
    public function deleted()
    {
        return $this->andWhere('deleted_at is not null');
    }
    public function notDeleted()
    {
        return $this->andWhere('deleted_at is null');
    }
    public function active()
    {
        return $this->andWhere("aktif=1");
    }
    public function notActive()
    {
        return $this->andWhere("aktif=0");
    }
    public function cancel()
    {
        return $this->andWhere("batal=1");
    }
    public function notCancel()
    {
        return $this->andWhere("batal=0");
    }
    public function final()
    {
        return $this->andWhere("final=1");
    }
    public function notFinal()
    {
        return $this->andWhere("final=0");
    }
    // public function all($db = null)
    // {
    //     return parent::all($db);
    // }
    // public function one($db = null)
    // {
    //     return parent::one($db);
    // }
    // public function init()
    // {
    //     $this->andOnCondition(['deleted' => false]);
    //     parent::init();
    // }

    // // ... add customized query methods here ...

    // public function active($state = true)
    // {
    //     return $this->andOnCondition(['active' => $state]);
    // }
}