<?php
namespace acl;

use Graphene\models\Model;

class Group extends Model{
    public function defineStruct(){
        return array(
            'name'   =>  Model::STRING.Model::MAX_LEN.'200'.Model::NOT_EMPTY.Model::NOT_NULL.Model::UNIQUE,
            'parent' =>  Model::STRING.Model::MAX_LEN.'200'.Model::NOT_EMPTY
        );
    }
    public function standardize(){
        $this->content['name']=self::standardizeGroupName($this->content['name'] );
        if($this->content['parent'] === null || $this->content['parent'] === ''){$this->content['parent'] = self::$everyoneGroupName;}
        else{$this->content['parent'] = self::standardizeGroupName($this->content['parent']);}
    }

    public static function standardizeGroupName($groupName){
        return strtoupper(str_replace(' ','_',$groupName));
    }

    public static $superUserGroupName = 'SUPER_USER';
    public static $everyoneGroupName  = 'EVERYONE';
}