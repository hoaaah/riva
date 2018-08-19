<?php
namespace app\models;

use yii\base\Model;
use Yii;
use yii\data\SqlDataProvider;
use yii\helpers\ArrayHelper;

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

    public function getKlasifikasiLaporan()
    {
        return [
            1 => 'Nilai Maturitas SPIP',
            2 => 'Fokus SPIP yang Belum Ditindaklanjuti', 
        ];
    }

    public function getKlasifikasiUnsur()
    {
        $unsur = RefUnsur::find()->all();
        return ArrayHelper::map($unsur, 'kd_unsur', 'name');
    }

    public function getRender()
    {
        $render = null;
        switch ($this->kd_laporan) {
            case 1:
                $render = 'laporan1';
                break;
            case 2:
                $render = 'laporan2';
            default:
                # code...
                break;
        }

        return $render;
    }

    /**
     * kd_laporan 1 Nilai Maturitas SPIP Kabupaten, jika dipilih kd_unsur maka diubah menjadi query per sub unsur
     * kd_laporan 2 Fokus spip yang belum ditindaklanjuti
     */
    public function getDataProvider()
    {
        $dataProvider = null;
        if(!$this->kd_unsur) $this->kd_unsur = 0;
        
        switch ($this->kd_laporan) {
            case 1:
                $totalCount = Yii::$app->db->createCommand("
                    SELECT COUNT(a.fokus) FROM
                    (
                        SELECT a.fokus, a.level, a.bobot,
                        SUM(a.bobot * a.level) AS skor 
                        FROM
                        (
                            SELECT b.kd_unsur, b.kd_sub_unsur,
                            CASE
                                WHEN :kd_unsur != '%' THEN b.name
                                ELSE e.name
                            END AS fokus, 
                            a.bobot,
                            CASE
                                WHEN d.level_akhir IS NULL THEN IFNULL(c.level_awal, 0)
                                ELSE d.level_akhir
                            END AS level
                            FROM
                            ref_bobot_sub_unsur AS a
                            INNER JOIN ref_sub_unsur AS b ON a.sub_unsur_id = b.id
                            INNER JOIN ref_unsur e ON b.kd_unsur = e.kd_unsur
                            LEFT JOIN ta_rencana_tindak AS c ON c.sub_unsur_id = b.id
                            LEFT JOIN ta_analisis_tl d ON c.id = d.rencana_tindak_id
                            WHERE b.kd_unsur LIKE :kd_unsur AND (c.tahun = :tahun OR c.tahun IS NULL)
                            ORDER BY b.kd_unsur, b.kd_sub_unsur ASC
                        ) a
                        GROUP BY a.fokus
                        ORDER BY a.kd_unsur, a.kd_sub_unsur ASC 
                    )a
                ", [
                    ':kd_unsur' => $this->kd_unsur == 0 ? '%' : $this->kd_unsur,
                    ':tahun' => isset($tahun) ? $tahun : date('Y')
                ])->queryScalar();

                $dataProvider = new SqlDataProvider([
                    'sql' => "
                        SELECT a.fokus, a.level, a.bobot,
                        SUM(a.bobot * a.level) AS skor 
                        FROM
                        (
                            SELECT b.kd_unsur, b.kd_sub_unsur,
                            CASE
                                WHEN :kd_unsur != '%' THEN b.name
                                ELSE e.name
                            END AS fokus, 
                            a.bobot,
                            CASE
                                WHEN d.level_akhir IS NULL THEN IFNULL(c.level_awal, 0)
                                ELSE d.level_akhir
                            END AS level
                            FROM
                            ref_bobot_sub_unsur AS a
                            INNER JOIN ref_sub_unsur AS b ON a.sub_unsur_id = b.id
                            INNER JOIN ref_unsur e ON b.kd_unsur = e.kd_unsur
                            LEFT JOIN ta_rencana_tindak AS c ON c.sub_unsur_id = b.id
                            LEFT JOIN ta_analisis_tl d ON c.id = d.rencana_tindak_id
                            WHERE b.kd_unsur LIKE :kd_unsur AND (c.tahun = :tahun OR c.tahun IS NULL)
                            ORDER BY b.kd_unsur, b.kd_sub_unsur ASC
                        ) a
                        GROUP BY a.fokus
                        ORDER BY a.kd_unsur, a.kd_sub_unsur ASC
                    ",
                    'params' => [
                        ':kd_unsur' => $this->kd_unsur == 0 ? '%' : $this->kd_unsur,
                        ':tahun' => isset($tahun) ? $tahun : date('Y')
                    ],
                    'totalCount' => $totalCount,
                    'pagination' => [
                        'pageSize' => 0,
                    ],
                ]);
                break;
            case 2:
                $totalCount = Yii::$app->db->createCommand("
                    SELECT COUNT(a.fokus) FROM
                    (
                        SELECT a.fokus, a.level, a.bobot,
                        SUM(a.bobot * a.level) AS skor 
                        FROM
                        (
                            SELECT b.kd_unsur, b.kd_sub_unsur,
                            CASE
                                WHEN :kd_unsur != '%' THEN b.name
                                ELSE e.name
                            END AS fokus, 
                            a.bobot,
                            CASE
                                WHEN d.level_akhir IS NULL THEN IFNULL(c.level_awal, 0)
                                ELSE d.level_akhir
                            END AS level
                            FROM
                            ref_bobot_sub_unsur AS a
                            INNER JOIN ref_sub_unsur AS b ON a.sub_unsur_id = b.id
                            INNER JOIN ref_unsur e ON b.kd_unsur = e.kd_unsur
                            LEFT JOIN ta_rencana_tindak AS c ON c.sub_unsur_id = b.id
                            LEFT JOIN ta_analisis_tl d ON c.id = d.rencana_tindak_id
                            WHERE b.kd_unsur LIKE :kd_unsur AND (c.tahun = :tahun OR c.tahun IS NULL)
                            ORDER BY b.kd_unsur, b.kd_sub_unsur ASC
                        ) a
                        GROUP BY a.fokus
                        ORDER BY a.kd_unsur, a.kd_sub_unsur ASC 
                    )a
                ", [
                    ':kd_unsur' => $this->kd_unsur == 0 ? '%' : $this->kd_unsur,
                    ':tahun' => isset($tahun) ? $tahun : date('Y')
                ])->queryScalar();

                $dataProvider = new SqlDataProvider([
                    'sql' => "
                        SELECT b.kd_unsur, b.kd_sub_unsur,
                        b.name AS fokus, c.rencana_tindak, c.output, c.penanggung_jawab, c.batas_waktu_tl
                        FROM
                        ref_bobot_sub_unsur AS a
                        INNER JOIN ref_sub_unsur AS b ON a.sub_unsur_id = b.id
                        INNER JOIN ref_unsur e ON b.kd_unsur = e.kd_unsur
                        INNER JOIN ta_rencana_tindak AS c ON c.sub_unsur_id = b.id
                        LEFT JOIN ta_analisis_tl d ON c.id = d.rencana_tindak_id
                        LEFT JOIN ta_tindak_lanjut f ON c.id = f.rencana_tindak_id
                        WHERE b.kd_unsur LIKE :kd_unsur AND (c.tahun = :tahun OR c.tahun IS NULL) AND f.id IS NULL
                        ORDER BY b.kd_unsur, b.kd_sub_unsur ASC
                    
                    ",
                    'params' => [
                        ':kd_unsur' => $this->kd_unsur == 0 ? '%' : $this->kd_unsur,
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