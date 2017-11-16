<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "photo".
 *
 * @property integer $id
 * @property string $description
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $album_id
 */
class Photo extends \yii\db\ActiveRecord
{
    public function behaviors(){
        return [
            [
                'class'=>TimestampBehavior::className(),
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'photo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['album_id'], 'required'],
            [['created_at', 'updated_at', 'album_id'], 'integer'],
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'album_id' => 'Album ID',
        ];
    }

    public function extraFields() {

        return [
            'photos'
        ];
    }

    public function getPhotos(){
        $data = PhotoItem::find()->where(['photo_id'=>$this->id])->all();

        $return = [];
        foreach($data as $item){
            $return[] = [
                'id'=>$item->id,
                'path'=>Yii::$app->request->getHostInfo()."/static/".$item->path
            ];
        }

        return $return;
    }

}
