<?php

namespace backend\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "report".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $submit_date
 * @property integer $project_id
 * @property integer $division_id
 * @property integer $requested_user_id
 * @property integer $approved_user_id
 * @property string $file
 *
 * @property Division $division
 * @property Project $project
 * @property User $requestedUser
 * @property User $approvedUser
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
            [['submit_date'], 'safe'],
            [['project_id', 'division_id', 'requested_user_id'], 'required'],
            [['project_id', 'division_id', 'requested_user_id', 'approved_user_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['content'], 'string', 'max' => 10000],
            [['file'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'submit_date' => 'Submit Date',
            'project_id' => 'Relevent Project',
            'division_id' => 'Division Name',
            'requested_user_id' => 'Requested User ID',
            'approved_user_id' => 'Approved User ID',
            'file' => 'File',
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
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestedUser()
    {
        return $this->hasOne(User::className(), ['id' => 'requested_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApprovedUser()
    {
        return $this->hasOne(User::className(), ['id' => 'approved_user_id']);
    }
}
