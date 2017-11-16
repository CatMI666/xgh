<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "photo_item".
 *
 * @property integer $id
 * @property integer $photo_id
 * @property integer $album_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $path
 * @property integer $type
 */
class PhotoItem extends \yii\db\ActiveRecord
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
        return 'photo_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['photo_id', 'album_id',  'path'], 'required'],
            [['photo_id', 'album_id', 'created_at', 'updated_at', 'type'], 'integer'],
            [['path'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'photo_id' => 'Photo ID',
            'album_id' => 'Album ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'path' => 'Path',
            'type' => 'Type',
        ];
    }



}
