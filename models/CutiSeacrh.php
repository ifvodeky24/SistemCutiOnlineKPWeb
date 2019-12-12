<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cuti;

/**
 * CutiSeacrh represents the model behind the search form of `app\models\Cuti`.
 */
class CutiSeacrh extends Cuti
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_cuti', 'id_user', 'jumlah_cuti'], 'integer'],
            [['Keterangan', 'tanggal_mulai', 'tanggal_selesai', 'status'], 'safe'],
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
        $query = Cuti::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_cuti' => $this->id_cuti,
            'id_user' => $this->id_user,
            'tanggal_mulai' => $this->tanggal_mulai,
            'tanggal_selesai' => $this->tanggal_selesai,
            'jumlah_cuti' => $this->jumlah_cuti,
        ]);

        $query->andFilterWhere(['like', 'Keterangan', $this->Keterangan])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
