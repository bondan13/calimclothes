<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $hp
 * @property string $password
 * @property string $nama
 * @property string $wilayah_id
 * @property string $alamat
 * @property string $level
 */
class User extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public $kota;
    public $kecamatan;

    public function tableName() {
        return 'user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('hp, password, nama, level, wilayah_id', 'required'),
            array('hp', 'match', 'pattern' => '/^([0]{1}+[0-9 ]{8,11})$/', 'message' => 'Nomor Handphone salah'),
            array('nama,alamat', 'length', 'min' => 4, 'tooShort' => '{attribute} minimal 4 karaketer'),
            array('nama', 'match', 'pattern' => '/^([a-zA-Z  \'\.\,])+$/', 'message' => '{attribute} tidak boleh menggunakan simbol'),
            array('nama', 'length', 'max' => 32),
            array('wilayah_id', 'length', 'max' => 8, 'message' => 'Kode Wilayah Salah'),
            array('alamat,kota,kecamatan', 'required', 'on' => 'create'),
            array('hp', 'length', 'max' => 12),
            array('password, nama, level', 'length', 'max' => 32),
            array('wilayah_id', 'length', 'max' => 8),
            array('alamat', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, hp, password, nama, wilayah_id, alamat, level', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'wilayah'=>array(self::BELONGS_TO, 'JneTangerang', 'wilayah_id'),
            'alltransaksi'=>array(self::STAT,'Transaksi','user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'hp' => 'Hp',
            'password' => 'Password',
            'nama' => 'Nama',
            'wilayah_id' => 'Wilayah',
            'alamat' => 'Alamat',
            'level' => 'Level',
            'kota' => 'Kota / Kabupaten',
            'kecamatan' => 'Kecamatan',
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
        $criteria->compare('hp', $this->hp, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('nama', $this->nama, true);
        $criteria->compare('wilayah_id', $this->wilayah_id, true);
        $criteria->compare('alamat', $this->alamat, true);
        $criteria->compare('level', $this->level, true);
        $criteria->order = 'id DESC';


        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function beforeSave() {
        if ($this->isNewRecord) {
            $this->password = crypt($this->password, 'bondan');
        }
        return true;
    }

}
