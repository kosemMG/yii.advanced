<?php

namespace frontend\models\tables;

use frontend\validators\DateValidator;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use DateTime;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $creator_id
 * @property int $executor_id
 * @property string $due_date
 * @property int $status_id
 * @property TaskStatuses $status
 * @property Users $creator
 * @property Users $executor
 * @property DateTime $created_at
 * @property DateTime $updated_at
 * @property TaskFiles[] $files
 * @property TaskComments[] $comments
 */
class Tasks extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['creator_id', 'executor_id', 'status_id'], 'integer'],
            [['due_date'], DateValidator::class],
            [['title'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => Yii::t('app', 'title'),
            'description' => Yii::t('app', 'description'),
            'creator_id' => Yii::t('app', 'creator'),
            'executor_id' => Yii::t('app', 'executor'),
            'due_date' => Yii::t('app', 'due_date'),
            'status_id' => Yii::t('app', 'status')
        ];
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(TaskStatuses::class, ['id' => 'status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasOne(Users::class, ['id' => 'creator_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExecutor()
    {
        return $this->hasOne(Users::class, ['id' => 'executor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(TaskFiles::class, ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(TaskComments::class, ['task_id' => 'id']);
    }
}
