<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "photo".
 *
 * @property integer $id
 * @property string $description
 * @property string $path
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $album_id
 * @property string $size
 * @property integer $width
 * @property integer $height
 * @property integer $type
 */
class Photo extends \yii\db\ActiveRecord
{
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
            [['path', 'created_at', 'updated_at', 'album_id'], 'required'],
            [['created_at', 'updated_at', 'album_id', 'width', 'height', 'type'], 'integer'],
            [['size'], 'number'],
            [['description'], 'string', 'max' => 255],
            [['path'], 'string', 'max' => 128],
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
            'path' => 'Path',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'album_id' => 'Album ID',
            'size' => 'Size',
            'width' => 'Width',
            'height' => 'Height',
            'type' => 'Type',
        ];
    }
}
