<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\SkillType;

class SkillTypeRepository extends Repository
{

  public function __construct()
  {
    $this->builder = new SkillType();
  }

  public function createByUser($professionTypeData) {
    return $this->builder->createByUser($professionTypeData);
  }

  public function all()
  {
    return $this->getBuilder()->latest()->get();
  }

  public function idByBody($body)
  {
    return $this->getBuilder()->where('body', $body)->first(['id']);
  }

}