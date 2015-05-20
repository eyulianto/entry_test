<?php

namespace App\Model;

use Eloquent;

class Article extends Eloquent {
   const TABLENAME = 'article';

   public function __construct() {
      parent::__construct();
      $this->table = self::TABLENAME;
      $this->fillable = ['title', 'url', 'thumbnail_url', 'summary', 'content', 'publish_date'];
   }
}