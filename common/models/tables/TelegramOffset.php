<?php

namespace common\models\tables;

use Yii;

/**
 * This is the model class for table "telegram_offset".
 *
 * @property int $id
 * @property string $timestamp
 */
class TelegramOffset extends \yii\db\ActiveRecord
{
    private $offset = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'telegram_offset';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['timestamp'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'timestamp' => 'Timestamp',
        ];
    }

    /**
     * Gets command message offset.
     * @return int|mixed
     */
    public function getOffset()
    {
        $max = static::find()
            ->select('id')
            ->max('id');

        if ($max > 0) {
            $this->offset = $max;
        }

        return $this->offset;
    }

    /**
     * Updates command message offset.
     * @param int $id
     */
    public function updateOffset(int $id)
    {
        (new static([
            'id' => $id,
            'timestamp' => date('Y-m-d h:i:s')
        ]))->save();
    }
}
