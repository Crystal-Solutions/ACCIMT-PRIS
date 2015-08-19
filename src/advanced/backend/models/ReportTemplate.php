<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "report_template".
 *
 * @property string $id
 * @property string $name
 * @property string $content
 */
class ReportTemplate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'report_template';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 64],
            [['content'], 'string', 'max' => 10000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'content' => 'Content',
        ];
    }
}
