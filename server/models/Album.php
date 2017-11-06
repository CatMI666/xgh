<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "album".
 *
 * @property integer $id
 * @property string $name
 * @property integer $created_at
 * @property integer $updated_at
 */
class Album extends \yii\db\ActiveRecord
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
        return 'album';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function extraFields()
    {
        return [
            'formatUpdateTime','photoTotal'
        ];
    }

    public function getFormatUpdateTime(){
        return date('Y-m-d H:i:s',$this->updated_at);
    }

    public function getPhotoTotal(){
        return Photo::find()->where(['album_id'=>$this->id])->count();
    }
}
