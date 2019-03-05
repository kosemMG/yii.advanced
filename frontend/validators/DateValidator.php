<?php

namespace frontend\validators;


use yii\validators\Validator;

class DateValidator extends Validator
{
    /**
     * Validates the specified object.
     * @param \yii\base\Model $model the data model being validated.
     * @param string $attribute an attribute to be validated.
     */
    public function validateAttribute($model, $attribute)
    {
        $value = $model->$attribute;

        if (!$this->parseDateString($value)) {
            $this->addError($model, $attribute, 'The date format should be: YYYY-MM-DD');
        }
    }

    /**
     * Parses a date string and compares to the assigned format.
     * @param string $date
     * @return bool
     */
    private function parseDateString(string $date): bool
    {
//        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date)) {
//            return true;
//        } else {
//            return false;
//        }

        $dt = \DateTime::createFromFormat("Y-m-d", $date);

        return $dt !== false && !array_sum(\DateTime::getLastErrors());
    }
}