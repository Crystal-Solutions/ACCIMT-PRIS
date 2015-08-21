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
 * @property string $created_at
 * @property string $approval_date
 * @property string $quarterly_targets
 * @property integer $team_leader
 * @property string $starting_date
 * @property string $end_date
 *
 * @property Division $division
 * @property Project $parentProject
 * @property Project[] $projects
 * @property ProjectType $projectType
 * @property User $requestedUser
 * @property User $approvedDdgUser
 * @property User $approvedDhUser
 * @property User $teamLeader
 * @property Report[] $reports
 * @property TeamMember[] $teamMembers
 * @property User[] $users
 */
class Project extends \yii\db\ActiveRecord
{
    public $users;
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
            [['name', 'requested_user_id', 'project_type_id','code'], 'required'],
            [['state'], 'string'],
            [['parent_project_id', 'requested_user_id', 'approved_ddg_user_id', 'approved_dh_user_id', 'project_type_id', 'division_id', 'team_leader'], 'integer'],
            [['created_at', 'approval_date', 'starting_date', 'end_date'], 'safe'],
            [['name', 'code', 'client'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 6000],
            [['quarterly_targets'], 'string', 'max' => 4000],
            ['code', 'match', 'pattern'=>'/[\d]/', 'message'=>'Invalid Project Code.']

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
            'parent_project_id' => 'Parent Project',
            'requested_user_id' => 'Requested User',
            'approved_ddg_user_id' => 'Approved DDG',
            'approved_dh_user_id' => 'Approved Depatment Head',
            'project_type_id' => 'Project Type',
            'division_id' => 'Division',
            'created_at' => 'Created At',
            'approval_date' => 'Approval Date',
            'quarterly_targets' => 'Quarterly Targets',
            'team_leader' => 'Team Leader',
            'starting_date' => 'Start Date',
            'end_date' => 'End Date',
            'users'=>'Team Members'
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
    public function getTeamLeader()
    {
        return $this->hasOne(User::className(), ['id' => 'team_leader']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReports()
    {
        return $this->hasMany(Report::className(), ['project_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeamMembers()
    {
        return $this->hasMany(TeamMember::className(), ['project_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('team_member', ['project_id' => 'id']);
    }
}
