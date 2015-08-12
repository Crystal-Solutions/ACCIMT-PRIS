<?php

namespace backend\models;


use Yii;
use common\models\User;

/**
 * This is the model class for table "project".
 *
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property string $client
 * @property string $state
 * @property string $description
 * @property integer $parent_project_id
 * @property integer $requested_user_id
 * @property integer $approved_ddg_user_id
 * @property integer $approved_dh_user_id
 * @property integer $project_type_id
 * @property integer $division_id
 *
 * @property Division $division
 * @property Project $parentProject
 * @property Project[] $projects
 * @property ProjectType $projectType
 * @property User $requestedUser
 * @property User $approvedDdgUser
 * @property User $approvedDhUser
 * @property Report[] $reports
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'requested_user_id', 'project_type_id'], 'required'],
            [['state'], 'string'],
            [['parent_project_id', 'requested_user_id', 'approved_ddg_user_id', 'approved_dh_user_id', 'project_type_id', 'division_id'], 'integer'],
            [['name', 'code', 'client'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 6000]
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
            'code' => 'Code',
            'client' => 'Client',
            'state' => 'State',
            'description' => 'Description',
            'parent_project_id' => 'Parent Project ID',
            'requested_user_id' => 'Requested User ID',
            'approved_ddg_user_id' => 'Approved Ddg User ID',
            'approved_dh_user_id' => 'Approved Dh User ID',
            'project_type_id' => 'Project Type ID',
            'division_id' => 'Division ID',
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
    public function getParentProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'parent_project_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjects()
    {
        return $this->hasMany(Project::className(), ['parent_project_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectType()
    {
        return $this->hasOne(ProjectType::className(), ['id' => 'project_type_id']);
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
    public function getApprovedDdgUser()
    {
        return $this->hasOne(User::className(), ['id' => 'approved_ddg_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApprovedDhUser()
    {
        return $this->hasOne(User::className(), ['id' => 'approved_dh_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReports()
    {
        return $this->hasMany(Report::className(), ['project_id' => 'id']);
    }
}
