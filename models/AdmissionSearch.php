<?php

namespace app\models;

use kartik\daterange\DateRangeBehavior;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Admission;
use yii\helpers\VarDumper;

/**
 * AdmissionSearch represents the model behind the search form of `app\models\Admission`.
 * @property int $department_id [int(11)]
 */
class AdmissionSearch extends Admission
{
    public $createTimeRange;
    public $createTimeStart;
    public $createTimeEnd;

    public function behaviors()
    {
        return [
            [
                'class' => DateRangeBehavior::className(),
                'attribute' => 'createTimeRange',
                'dateStartAttribute' => 'createTimeStart',
                'dateEndAttribute' => 'createTimeEnd',
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'type', 'department_id', 'room', 'is_discharged', 'iin', 'updated_at', 'created_at'], 'integer'],
            [['full_name'], 'safe'],
            [['createTimeRange'], 'match', 'pattern' => '/^.+\s\-\s.+$/'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
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
        $query = Admission::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> [
                'defaultOrder'   => ['created_at' => SORT_DESC]
            ],
            'pagination' => [
                'pageSize' => 15,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'status' => $this->status,
            'type' => $this->type,
            'department_id' => $this->department_id,
            'room' => $this->room,
            'is_discharged' => $this->is_discharged,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere([
            'OR',
            ['like', 'full_name', $this->full_name],
            ['like', 'iin', $this->full_name],
        ]);

        $query->andFilterWhere(['>=', 'created_at', $this->createTimeStart])
            ->andFilterWhere(['<', 'created_at', $this->createTimeEnd]);

        return $dataProvider;
    }
}
