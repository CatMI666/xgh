<?php

namespace app\modules\xcx\controllers;

use app\models\Photo;
use Yii;
use yii\base\Exception;
use yii\rest\ActiveController;
use yii\web\UploadedFile;
use app\models\N8Folder;
use yii\data\ActiveDataProvider;

class PhotoItemController extends ActiveController {
    public $modelClass = 'app\models\PhotoItem';

    public function actions() {
        $actions = parent::actions();
        unset($actions['create']);
        $actions['index']['prepareDataProvider'] = [$this,'prepareDataProvider'];
        return $actions;
    }

    public function prepareDataProvider(){
        $params = Yii::$app->request->queryParams;

        $query = Photo::find()->where(['album_id'=>$params['album_id']]);
        $provider = new ActiveDataProvider([
            'query'=>$query->orderBy(['created_at'=>SORT_DESC])
        ]);

        return $provider;
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

    public function actionAdd(){
        $video = UploadedFile::getInstanceByName('file');
        $body = Yii::$app->getRequest()->getBodyParams();

        if($video == false){
            throw new Exception('文件上传失败');
        }

        $ext = $video->getExtension();
        $path_result = N8Folder::createItemPath('video',$ext);
        $video->saveAs($path_result['save_path']);

        $modelClass = $this->modelClass;
        $model = new $modelClass();
        $model->photo_id = $body['photo_id'];
        $model->album_id = $body['album_id'];
        $model->path = $path_result['web_path'];
        $model->type = 2;
        $model->save();

        return $model;
    }
}