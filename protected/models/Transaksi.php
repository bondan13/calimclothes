<?php

/**
 * This is the model class for table "transaksi".
 *
 * The followings are the available columns in table 'transaksi':
 * @property integer $id
 * @property integer $invoice_id
 * @property integer $user_id
 * @property integer $barang_id
 * @property integer $jumlah
 * @property double $berat
 * @property string $total_harga
 * @property integer $status
 * @property string $tanggal_bayar
 * @property string $tanggal_kirim
 * @property string $tanggal
 * @property string $resi
 */
class Transaksi extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'transaksi';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('invoice_id, user_id, barang_id, jumlah, berat, total_harga, tanggal', 'required'),
			array('invoice_id, user_id, barang_id, jumlah, status', 'numerical', 'integerOnly'=>true),
			array('berat', 'numerical'),
			array('total_harga', 'length', 'max'=>11),
			array('resi', 'length', 'max'=>45),
			array('tanggal_bayar, tanggal_kirim', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, invoice_id, user_id, barang_id, jumlah, berat, total_harga, status, tanggal_bayar, tanggal_kirim, tanggal, resi', 'safe', 'on'=>'search'),
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
			'invoice_id' => 'Invoice',
			'user_id' => 'User',
			'barang_id' => 'Barang',
			'jumlah' => 'Jumlah',
			'berat' => 'Berat',
			'total_harga' => 'Total Harga',
			'status' => 'Status',
			'tanggal_bayar' => 'Tanggal Bayar',
			'tanggal_kirim' => 'Tanggal Kirim',
			'tanggal' => 'Tanggal',
			'resi' => 'Resi',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('invoice_id',$this->invoice_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('barang_id',$this->barang_id);
		$criteria->compare('jumlah',$this->jumlah);
		$criteria->compare('berat',$this->berat);
		$criteria->compare('total_harga',$this->total_harga,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('tanggal_bayar',$this->tanggal_bayar,true);
		$criteria->compare('tanggal_kirim',$this->tanggal_kirim,true);
		$criteria->compare('tanggal',$this->tanggal,true);
		$criteria->compare('resi',$this->resi,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Transaksi the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}