<?php

namespace App\Model\Rss;

use App\Model\Content\Downloader;
use DateTime;
use DateTimeZone;
use Exception;

class Processor {
   protected $_downloader = null;

   public function __construct(Downloader $downloader = null) {
      $this->_downloader = $downloader;
   }

   /**
   *  parse RSS content
   *
   *  @param String
   *  @return mixed (SimpleXMLElement | Boolean)
   */
   public function parseContent($content) {
      if (empty($content)) {
         return false;
      }

      libxml_use_internal_errors(true);
      $xmlElement = simplexml_load_string($content);

      return $xmlElement;
   }

   /**
   *  convert date to UTC timezone and "Y-m-d H:i:s" format
   *  
   *  @param String
   *  @return String
   */
   protected function _convertPublishDate($date) {
      $dateTime = new DateTime($date);
      $dateTime->setTimezone(new DateTimeZone('UTC'));

      return $dateTime->format('Y-m-d H:i:s');
   }

   /**
   *  extract items from xml string
   *
   *  @param String
   *  @return Array
   */
   public function extractItemsFromXml($rssXml) {
      $result = array();

      foreach ($rssXml->channel->item as $item) {
         $data = array(
            'title' => $item->title,
            'url' => $item->link,
            'summary' => $item->description,
            'thumbnail_url' => '',
            'content' => '',
            'publish_date' => ''
         );
         
         $namespaces = $item->getNamespaces(true);
         if (isset($namespaces['content'])) {
            $content = $item->children($namespaces['content']);
            $data['content'] = $content->encoded;
         }

         $data['publish_date'] = $this->_convertPublishDate($item->pubDate);

         $enclosure = $item->enclosure;
         if ($enclosure->count() > 0) {
            $attributes = $enclosure->attributes();
            if (strpos($attributes['type'], 'image') !== false) {
               $data['thumbnail_url'] = $attributes['url'];
            }
         }

         $result[] = $data;  
      }

      return $result;
   }

   /**
   *  extract items from URL
   *
   *  @param String
   *  @return Array
   */
   public function extractItemsFromUrl($rssUrl) {
      $content = $this->_downloader->getContentFromUrl($rssUrl);
      if ($content === "") {
         throw new Exception('Error in downloading content from '.$rssUrl);
      }

      $rssXml = $this->parseContent($content);
      if($rssXml === false) {
         throw new Exception('Error in parsing content from '.$rssUrl);
      }

      return $this->extractItemsFromXml($rssXml);
   }
}