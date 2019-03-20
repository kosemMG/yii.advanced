<?php

namespace common\models\tables;

use Yii;

/**
 * This is the model class for table "telegram_subscriptions".
 *
 * @property int $id
 * @property int $telegram_user_id
 * @property string $channel
 */
class TelegramSubscriptions extends \yii\db\ActiveRecord
{
    const PROJECT_CREATION = 'project_create';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'telegram_subscriptions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['telegram_user_id'], 'integer'],
            [['channel'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'telegram_user_id' => 'Telegram User ID',
            'channel' => 'Channel',
        ];
    }

    /**
     * Checks if the subscriber already exists.
     * @param $fromId
     * @return bool
     */
    public function subscriberExists($fromId)
    {
        $subscriberIds = TelegramSubscriptions::find()
            ->select('telegram_user_id')
            ->where(['channel' => TelegramSubscriptions::PROJECT_CREATION])
            ->column();

        foreach ($subscriberIds as $subscriberId) {
            if ($subscriberId == $fromId) {
                return true;
            }
        }

        return false;
    }
}
