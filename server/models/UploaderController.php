<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\db\Exception;
use yii\helpers\Json;
use app\models\N8Folder;

class UploaderController extends Controller {

    public $enableCsrfValidation = false;

    public function actionSimple($type = 'dish',$name = 'file',$exts = ''){
        try{
            $image = UploadedFile::getInstanceByName($name);
            if(empty($image)){
                throw new Exception('上传失败');
            }

            $ext = $image->getExtension();

            if($exts && !in_array($ext,explode('@',$exts))){
                throw new Exception('您只能上传'.str_replace('@',',',$exts)."类型文件");
            }

            $ext = $image->getExtension() ? $image->getExtension() : 'mp4';
            $path_result = N8Folder::createItemPath($type,$ext);
            $image->saveAs($path_result['save_path']);

            echo Json::encode(['success'=>true,'file_path'=>$path_result['web_path']]);
        }catch(Exception $e){
            echo Json::encode(['done'=>false,'error'=>$e->getMessage()]);
        }

    }
}

