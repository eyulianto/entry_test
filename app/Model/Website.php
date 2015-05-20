<?php

namespace App\Model;

use Eloquent;

class Website extends Eloquent {
   const TABLENAME = 'website';

   public function __construct() {
      parent::__construct();
      $this->table = self::TABLENAME;
      $this->fillable = ['name', 'url', 'rss_url'];
   }
}