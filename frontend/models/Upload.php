<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\imagine\Image;
use yii\web\UploadedFile;


/**
 * Class Upload
 * @package app\models
 */
class Upload extends Model
{
    public $title;
    public $content;

    /**
     * @var UploadedFile
     */
    public $file;

    /**
     * List of validation rules.
     * @return array
     */
    public function rules()
    {
        return [
            [['title', 'content'], 'safe'],
            ['file', 'file', 'extensions' => 'jpg, jpeg, png, gif, pdf, txt, doc, docx, odt']
        ];
    }

    public function attributeLabels()
    {
        return [
            'file' => Yii::t('app', 'file')
        ];
    }


    /**
     * The class main method.
     */
    public function run()
    {
        if ($this->validate()){
            $filename = $this->getFileName();
            $filepath = Yii::getAlias("@img/{$filename}");

            $this->file->saveAs($filepath);

            Image::thumbnail($filepath, 100, 100)
                ->save(Yii::getAlias("@img/small/{$filename}"));

            Yii::$app->session->setFlash('success', Yii::t('app', 'file-success'));

            return $filename;
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', 'file-error'));
            return false;
        }
    }

    /**
     * Returns full file name.
     * @return string
     */
    private function getFileName()
    {
        return $this->file->getBaseName() . '.' . $this->file->getExtension();
    }
}