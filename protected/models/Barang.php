<?php

/**
 * This is the model class for table "barang".
 *
 * The followings are the available columns in table 'barang':
 * @property integer $id
 * @property string $nama
 * @property string $deskripsi
 * @property string $harga
 * @property double $berat
 * @property integer $s_stok
 * @property integer $m_stok
 * @property integer $l_stok
 * @property integer $xl_stok
 * @property integer $allsize_stok
 * @property integer $kategori_id
 */
class Barang extends CActiveRecord {

    public $gambar;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'barang';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('nama, berat, kategori_id, harga, s_stok, m_stok, l_stok, xl_stok, allsize_stok, deskripsi', 'required'),
            array('s_stok, m_stok, l_stok, xl_stok, allsize_stok, kategori_id', 'numerical', 'integerOnly' => true),
            array('berat', 'numerical'),
            array('gambar', 'required', 'on' => 'create,updategambar'),
            array('gambar', 'file', 'allowEmpty' => true, 'types' => 'jpg'),
            array('nama', 'length', 'max' => 100),
            array('harga', 'length', 'max' => 11),
            array('deskripsi', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, nama, deskripsi, harga, berat, s_stok, m_stok, l_stok, xl_stok, allsize_stok, kategori_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'kategori'=>array(self::BELONGS_TO, 'Kategori', 'kategori_id')
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'nama' => 'Nama',
            'deskripsi' => 'Deskripsi',
            'harga' => 'Harga',
            'berat' => 'Berat',
            's_stok' => 'S Stok',
            'm_stok' => 'M Stok',
            'l_stok' => 'L Stok',
            'xl_stok' => 'XL Stok',
            'allsize_stok' => 'Allsize Stok',
            'kategori_id' => 'Kategori',
            'gambar' => 'gambar',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('nama', $this->nama, true);
        $criteria->compare('deskripsi', $this->deskripsi, true);
        $criteria->compare('harga', $this->harga, true);
        $criteria->compare('berat', $this->berat);
        $criteria->compare('s_stok', $this->s_stok);
        $criteria->compare('m_stok', $this->m_stok);
        $criteria->compare('l_stok', $this->l_stok);
        $criteria->compare('xl_stok', $this->xl_stok);
        $criteria->compare('allsize_stok', $this->allsize_stok);
        $criteria->compare('kategori_id', $this->kategori_id);
        $criteria->order = 'id DESC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Barang the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public function hargaRupiah(){
        $harga = number_format($this->harga,0,',','.');
        return 'Rp '.$harga;
    }
    
    public function namaSubstr(){
        if(strlen($this->nama)>35){
            $string = substr($this->nama, 0, 32).'...';
            return $string;
        }
        else {
            return $this->nama;
        }
    }
}
