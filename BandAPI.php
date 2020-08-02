<?php

/**
 * @name BandAPI
 * @main tjwls012\bandapi\BandAPI
 * @author ["tjwls012"]
 * @version 0.1
 * @api 3.14.0
 * @description License : LGPL 3.0
 */
 
namespace tjwls012\bandapi;
 
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;

use pocketmine\utils\Internet;

class BandAPI extends PluginBase implements Listener{

  public static $instance;
  
  public static function getInstance(){
  
    return self::$instance;
  }
  public function onLoad(){
  
    self::$instance = $this;
  }
  public function onEnable(){
  
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
  }
  public function getBands(string $acces_token = ""){
  
    $curl = curl_init();
    
    curl_setopt($curl, CURLOPT_URL, "https://openapi.band.us/v2.1/bands?access_token=$acces_token");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLINFO_HEADER_OUT, true);
    
    $json = curl_exec($curl);
    $decode = json_decode($json, true);
    
    curl_close($curl);
    
    var_dump($decode);
    
    return $json;
  }
  public function getPosts(string $acces_token = "", string $band_key = "", string $locale = ""){
  
    $curl = curl_init();
    
    curl_setopt($curl, CURLOPT_URL, "https://openapi.band.us/v2/band/posts?access_token=$acces_token&band_key=$band_key&locale=$locale");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLINFO_HEADER_OUT, true);
    
    $json = curl_exec($curl);
    $decode = json_decode($json, true);
    
    curl_close($curl);
    
    var_dump($decode);
    
    return $json;
  }
  public function writePost(string $acces_token = "", string $band_key = "", string $content = "", bool $do_push = false){
    
    $curl = curl_init();
    
    $post_file = "access_token=$acces_token&band_key=$band_key&content=" . urlencode($content) . "&do_push=" . $do_push;
    
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_URL, "https://openapi.band.us/v2.2/band/post/create");
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post_file);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLINFO_HEADER_OUT, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, ["Authorization: Bearer $acces_token"]);
    
    $json =curl_exec($curl);
    $decode = json_decode($json, true);
    
    curl_close($curl);
    
    var_dump($decode);
  }
  public function deletePost(string $acces_token = "", string $band_key = "", string $post_key = ""){
      
    $curl = curl_init();
    
    $post_file = "access_token=$acces_token&band_key=$band_key&post_key=$post_key";
    
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_URL, "https://openapi.band.us/v2/band/post/remove?");
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post_file);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLINFO_HEADER_OUT, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, ["Authorization: Bearer $acces_token"]);
    
    $json =curl_exec($curl);
    $decode = json_decode($json, true);
    
    curl_close($curl);
    
    var_dump($decode);
  }
  public function getComments(string $acces_token = "", string $band_key = "", string $post_key = "", string $sort = "+created_at"){
  
    $curl = curl_init();
    
    curl_setopt($curl, CURLOPT_URL, "https://openapi.band.us/v2/band/post/comments?access_token=$acces_token&band_key=$band_key&post_key=$post_key&sort=$sort");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLINFO_HEADER_OUT, true);
    
    $json = curl_exec($curl);
    $decode = json_decode($json, true);
    
    curl_close($curl);
    
    var_dump($decode);
    
    return $json;
  }
  public function writeComment(string $acces_token = "", string $band_key = "", string $post_key = "", string $body = ""){
  
    $curl = curl_init();
    
    $post_file = "access_token=$acces_token&band_key=$band_key&post_key=$post_key&body=$body";
    
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_URL, "https://openapi.band.us/v2/band/post/comment/create");
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post_file);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLINFO_HEADER_OUT, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, ["Authorization: Bearer $acces_token"]);
     
    $json = curl_exec($curl);
    $decode = json_decode($json, true);
    
    curl_close($curl);
    
    var_dump($decode);
  }
  public function deleteComment(string $acces_token = "", string $band_key = "", string $post_key = "", string $comment_key = ""){
  
    $curl = curl_init();
    
    $post_file = "access_token=$acces_token&band_key=$band_key&post_key=$post_key&comment_key=$comment_key";
    
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_URL, "https://openapi.band.us/v2/band/post/comment/remove");
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post_file);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLINFO_HEADER_OUT, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, ["Authorization: Bearer $acces_token"]);
     
    $json = curl_exec($curl);
    $decode = json_decode($json, true);
    
    curl_close($curl);
    
    var_dump($decode);
  }
  public function getPermissions(string $acces_token = "", string $band_key = "", string $permissions ="posting,commenting,contents_deletion"){
  
    $curl = curl_init();
    
    curl_setopt($curl, CURLOPT_URL, "https://openapi.band.us/v2/band/permissions?access_token=$acces_token&band_key=$band_key&permissions=$permissions");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLINFO_HEADER_OUT, true);
    
    $json = curl_exec($curl);
    $decode = json_decode($json, true);
    
    curl_close($curl);
    
    var_dump($decode);
    
    return $json;
  }
  public function getAlbums(string $acces_token = "", string $band_key = ""){
  
    $curl = curl_init();
    
    curl_setopt($curl, CURLOPT_URL, "https://openapi.band.us/v2/band/albums?access_token=$acces_token&band_key=$band_key");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLINFO_HEADER_OUT, true);
    
    $json = curl_exec($curl);
    $decode = json_decode($json, true);
    
    curl_close($curl);
    
    var_dump($decode);
    
    return $json;
  }
  public function getPhotos(string $acces_token = "", string $band_key = "", string $photo_album_key = ""){
  
    $curl = curl_init();
    
    $photo_data = ($photo_album_key === "") ? "" : "&photo_album_key=$photo_album_key";
    
    curl_setopt($curl, CURLOPT_URL, "https://openapi.band.us/v2/band/album/photos?access_token=$acces_token&band_key=$band_key".$photo_data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLINFO_HEADER_OUT, true);
    
    $json = curl_exec($curl);
    $decode = json_decode($json, true);
    
    curl_close($curl);
    
    var_dump($decode);
    
    return $json;
  }
}