<?php
include "amazonsdk/aws-autoloader.php";
use Aws\S3\S3Client;

class FileUpload{
    
    private $client;

    public function __construct() {

        $options = array(
            'region' => 'eu-central-1',
            'version' => 'latest',
            'scheme' => 'http',
            'credentials' => array('key' => 'AKIAJN7XU4O4S3VVYC2Q', 'secret' => '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')
        );

        $this->client = S3Client::factory($options);
        
    }
    
//    public function listBuckets(){
//        return $this->client->listBuckets();
//    }
//    
//    public function bucketInfo($name){
//        $data = $this->client->getIterator('ListObjects', array(
//                    'Bucket' => $bucketname
//                ));
//        return $data;
//    }
    public function __get($variable){
        if (property_exists($this, $variable)) {
             return $this->$variable;
        }
    }
    public function uploadItem($folder, $itemName, $filePath, $type = 'public-read'){

        $uploadDir = $folder.'/'.$itemName;
        $uploadSettings = array(
            'Bucket' => 'accomome',
            'Key' => $uploadDir,
            'SourceFile' => $filePath,
            'ACL' => $type
        );
        $result = $this->client->putObject($uploadSettings);

        $uploadData = $result->toArray();
        if($uploadData['@metadata']['statusCode'] == 200){
            return $uploadData['@metadata']['effectiveUri'];
        }else{
            return false;
        }
        
    }
    
    public function deleteItem($folder, $itemName){

        $itemDir = $folder.'/'.$itemName;
        $deleteSettings = array(
            'Bucket' => AwsS3Config::$bucket,
            'Key' => $itemDir
        );

        $result = $this->client->deleteObject($deleteSettings);
        $deleteData = $result->toArray();
        return $deleteData;
        
    }
    
    
    public function itemExists($folder,$itemName){

        if(strlen($itemName) > 0 ){
            $objectName = $folder.'/'.$itemName;
            $response = $this->client->doesObjectExist(AwsS3Config::$bucket, $objectName);
            return $response;
        }else{
            return FALSE;
        }

    }
    
    
    public function LinkUrl($s) {
        $tr = array('ş','Ş','ı','I','İ','ğ','Ğ','ü','Ü','ö','Ö','Ç','ç','(',')','/',':',',');
        $eng = array('s','s','i','i','i','g','g','u','u','o','o','c','c','','','-','-','');
        $s = str_replace($tr,$eng,$s);
        $s = strtolower($s);
        $s = preg_replace('/&amp;amp;amp;amp;amp;amp;amp;amp;amp;.+?;/', '', $s);
        $s = preg_replace('/\s+/', '-', $s);
        $s = preg_replace('|-+|', '-', $s);
        $s = preg_replace('/#/', '', $s);
        $s = str_replace('.', '', $s);
        $s = trim($s, '-');
        return $s;
    }
    
    public static function turkishreplace($sData){
        $newphrase=$sData;
        $newphrase = str_replace(" ","",$newphrase);
        $newphrase = str_replace("Ü","U",$newphrase);
        $newphrase = str_replace("Ş","S",$newphrase);
        $newphrase = str_replace("Ğ","G",$newphrase);
        $newphrase = str_replace("Ç","C",$newphrase);
        $newphrase = str_replace("İ","I",$newphrase);
        $newphrase = str_replace("Ö","O",$newphrase);
        $newphrase = str_replace("ü","u",$newphrase);
        $newphrase = str_replace("ş","s",$newphrase);
        $newphrase = str_replace("ç","c",$newphrase);
        $newphrase = str_replace("ı","i",$newphrase);
        $newphrase = str_replace("ö","o",$newphrase);
        $newphrase = str_replace("ğ","g",$newphrase);
        return $newphrase;
    }
}

