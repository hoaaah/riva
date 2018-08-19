<?php
namespace app\models;

use yii\base\Model;
use Yii;

class LaporanForm extends Model
{
    public $kd_laporan;
    public $kd_unsur;
    public $tgl_laporan;
    public $penandatangan;


    public function rules()
    {
        return [
            [['kd_laporan', 'kd_unsur'], 'integer'],
            [['tgl_laporan', 'penandatangan'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'kd_unsur' => Yii::t('app', 'kd_unsur'),
            'tgl_laporan' => Yii::t('app', 'tgl_laporan'),
            'kd_laporan' => Yii::t('app', 'kd_laporan'),
            'rememberMe' => Yii::t('app', 'Remember me'),
        ];
    }

    /**
     * kd_laporan 1 Nilai Maturitas SPIP Kabupaten, jika dipilih kd_unsur maka diubah menjadi query per sub unsur
     * kd_laporan 2 Fokus spip yang belum ditindaklanjuti
     */
    public function getDataProvider()
    {
        $dataProvider = null;
        
        switch ($this->kd_laporan) {
            case 1:
                $totalCount = Yii::$app->db->createCommand("
                    SELECT COUNT(b.kd_unsur)
                    FROM
                    ref_bobot_sub_unsur AS a
                    INNER JOIN ref_sub_unsur AS b ON a.sub_unsur_id = b.id
                    LEFT JOIN ta_rencana_tindak AS c ON c.sub_unsur_id = b.id
                    LEFT JOIN ta_analisis_tl d ON c.id = d.rencana_tindak_id
                    WHERE b.kd_unsur = :kd_unsur AND (c.tahun = :tahun OR c.tahun IS NULL)     
                ", [
                    ':kd_unsur' => $id,
                    ':tahun' => isset($tahun) ? $tahun : date('Y')
                ])->queryScalar();

                $dataProvider = new SqlDataProvider([
                    'sql' => "
                        SELECT b.kd_unsur, b.kd_sub_unsur, b.name, a.bobot,
                        CASE
                            WHEN d.level_akhir IS NULL THEN IFNULL(c.level_awal, 0)
                            ELSE d.level_akhir
                        END AS level
                        FROM
                        ref_bobot_sub_unsur AS a
                        INNER JOIN ref_sub_unsur AS b ON a.sub_unsur_id = b.id
                        LEFT JOIN ta_rencana_tindak AS c ON c.sub_unsur_id = b.id
                        LEFT JOIN ta_analisis_tl d ON c.id = d.rencana_tindak_id
                        WHERE b.kd_unsur = :kd_unsur AND (c.tahun = :tahun OR c.tahun IS NULL)            
                    ",
                    'params' => [
                        ':kd_unsur' => $id,
                        ':tahun' => isset($tahun) ? $tahun : date('Y')
                    ],
                    'totalCount' => $totalCount,
                    'pagination' => [
                        'pageSize' => 0,
                    ],
                ]);
                break;
            
            default:
                # code...
                break;
        }

        return $dataProvider;
    }

}