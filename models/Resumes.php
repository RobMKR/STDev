<?php

namespace app\models;


use yii\base\Model;
use yii\web\UploadedFile;
use yii\db\ActiveRecord;



class Resumes extends ActiveRecord
{
  public $file;




  public static function tableName()
    {
        return 'resumes';
    }


     /**
      * @return array the validation rules.
      */

     public function rules()
     {
         return [
                   [['firstname', 'lastname', 'keywords'], 'required', 'on'=>'insert'],
                   [['firstname', 'lastname', 'keywords'], 'beforeValidate', 'on'=>'search'],
                   [['file'], 'file', 'extensions'=>'pdf, txt, docx' ]

                 ];
     }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'keywords' => 'Keywords',

            'file' => "File To Upload"
        ];
    }
    public function beforeValidate()
    {
       if (parent::beforeValidate())
       {
          if (($this->firstname==null)&&($this->lastname==null)&&($this->keywords==null))
          {
                  $this->addError('firstname', 'One of fields must be filled');
                  $this->addError('lastname', 'One of fields must be filled');
                  $this->addError('keywords', 'One of fields must be filled');
                  return false;
          }

          return true;
       }
       return false;
    }
}
