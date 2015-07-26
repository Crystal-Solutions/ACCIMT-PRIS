<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "report".
 *
 * @property integer $id
 * @property integer $state
 * @property string $name
 * @property string $time
 * @property integer $project_id
 * @property integer $project_project_type_id1
 * @property integer $division_id
 * @property integer $user_id
 *
 * @property Division $division
 * @property Project $project
 * @property User $user
 */
class Report extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'report';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name', 'time', 'project_id', 'project_project_type_id1', 'division_id', 'user_id'], 'required'],
            [['id', 'state', 'project_id', 'project_project_type_id1', 'division_id', 'user_id'], 'integer'],
            [['time'], 'safe'],
            [['name'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'state' => 'State',
            'name' => 'Name',
            'time' => 'Time',
            'project_id' => 'Project ID',
            'project_project_type_id1' => 'Project Project Type Id1',
            'division_id' => 'Division ID',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDivision()
    {
        return $this->hasOne(Division::className(), ['id' => 'division_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id', 'project_type_id' => 'project_project_type_id1']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
