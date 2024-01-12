<?php

namespace app\modules\rbac\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * User represents the model behind the search form about `app\modules\rbac\models\User`.
 */
class User extends Model
{
    public $userid;
    public $username;
    public $nama;
    public $nomor;
    public $status_aktif_pegawai;
    public $id_nip_nrp;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'status_aktif_pegawai'], 'integer'],
            [['username', 'nama', 'id_nip_nrp'], 'safe'],
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        /* @var $query \yii\db\ActiveQuery */
        // $class = Yii::$app->getUser()->identityClass ? : 'app\modules\rbac\models\User';
        $class = Yii::$app->getUser()->identityClass ? : 'app\models\auth\User';
        $query = $class::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [ 
                'pageSize' => Yii::$app->params['setting']['paging']['size']['long']
            ]
        ]);

        $this->load($params);
        if (!$this->validate()) {
            $query->where('1=0');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'status_aktif_pegawai' => $this->status_aktif_pegawai,
        ]);

        $query->andFilterWhere(['ilike', 'username', $this->username])
        ->andFilterWhere(['ilike', 'id_nip_nrp', $this->id_nip_nrp])
        ->andFilterWhere(['ilike', 'nama', $this->nama]);

        return $dataProvider;
    }
}
