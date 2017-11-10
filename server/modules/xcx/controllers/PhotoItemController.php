<?php

namespace app\modules\xcx\controllers;

use Yii;
use yii\base\Exception;
use yii\rest\ActiveController;
use yii\web\UploadedFile;
use app\models\N8Folder;

class PhotoItemController extends ActiveController {
    public $modelClass = 'app\models\PhotoItem';

    public function actions() {
        $actions = parent::actions();
        unset($actions['create']);
        return $actions;
    }

    public function actionCreate(){
        $image = UploadedFile::getInstanceByName('file');
        $body = Yii::$app->getRequest()->getBodyParams();

        if($image == false){
            throw new Exception('文件上传失败');
        }

        $ext = $image->getExtension();
        $path_result = N8Folder::createItemPath('photo',$ext);
        $image->saveAs($path_result['save_path']);

        $modelClass = $this->modelClass;
        $model = new $modelClass();
        $model->photo_id = $body['photo_id'];
        $model->album_id = $body['album_id'];
        $model->path = $path_result['web_path'];
        $model->type = 1;
        $model->save();

        return $model;
    }
}