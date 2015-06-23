<?php

/**
 * This is the model class for table "jne_tangerang".
 *
 * The followings are the available columns in table 'jne_tangerang':
 * @property string $id
 * @property string $kota_kabupaten
 * @property string $kecamatan
 * @property integer $tarif_reg
 * @property string $etd_reg
 * @property integer $tarif_oke
 * @property string $etd_oke
 * @property integer $tarif_yes
 * @property string $date_created
 * @property string $last_updated
 */
class JneTangerang extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'jne_tangerang';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, kota_kabupaten, kecamatan, tarif_reg, etd_reg, date_created', 'required'),
			array('tarif_reg, tarif_oke, tarif_yes', 'numerical', 'integerOnly'=>true),
			array('id', 'length', 'max'=>8),
			array('kota_kabupaten, kecamatan', 'length', 'max'=>40),
			array('etd_reg, etd_oke', 'length', 'max'=>5),
			array('last_updated', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, kota_kabupaten, kecamatan, tarif_reg, etd_reg, tarif_oke, etd_oke, tarif_yes, date_created, last_updated', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'kota_kabupaten' => 'Kota Kabupaten',
			'kecamatan' => 'Kecamatan',
			'tarif_reg' => 'Tarif Reg',
			'etd_reg' => 'Etd Reg',
			'tarif_oke' => 'Tarif Oke',
			'etd_oke' => 'Etd Oke',
			'tarif_yes' => 'Tarif Yes',
			'date_created' => 'Date Created',
			'last_updated' => 'Last Updated',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('kota_kabupaten',$this->kota_kabupaten,true);
		$criteria->compare('kecamatan',$this->kecamatan,true);
		$criteria->compare('tarif_reg',$this->tarif_reg);
		$criteria->compare('etd_reg',$this->etd_reg,true);
		$criteria->compare('tarif_oke',$this->tarif_oke);
		$criteria->compare('etd_oke',$this->etd_oke,true);
		$criteria->compare('tarif_yes',$this->tarif_yes);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('last_updated',$this->last_updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return JneTangerang the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
