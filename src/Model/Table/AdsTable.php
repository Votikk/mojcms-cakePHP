<?php

// src/Model/Table/ArticlesTable.php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Text;

class AdsTable extends Table {

  public function initialize(array $config) {
    $this->addBehavior('Timestamp');
  }

  public function beforeSave($event, $entity, $options) {
    if ($entity->isNew() && !$entity->slug) {
      $sluggedTitle = Text::slug($entity->title);
      // trim slug to maximum length defined in schema
      $entity->slug = substr($sluggedTitle, 0, 191);
    }
  }
  
  public function validationDefault(Validator $validator) {
    $validator
            ->allowEmptyString('title', false)
            ->minLength('title', 1)
            ->maxLength('title', 255)
            ->allowEmptyString('body', true);

    return $validator;
  }

}
