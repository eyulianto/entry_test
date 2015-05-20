<?php

namespace App\Model\Content;

class Downloader {
   public function __construct() {}

   /**
   *  retrieve content from an URL
   *  
   *  @param String
   *  @return String
   */
   public function getContentFromUrl($Url) {
      $ch = curl_init($Url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $content = curl_exec($ch);
      $curlInfo = curl_getinfo($ch);
      curl_close($ch);
      
      if ($curlInfo['http_code'] == 200) {
         return $content;
      }
      
      return "";
   }
}