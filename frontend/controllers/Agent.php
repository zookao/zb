<?php
namespace frontend\controllers;

use Yii;
use common\helpers\CurlHelper;
use yii\helpers\FileHelper;

class Agent
{
    public static function agent1($address)
    {
        $path = '/web/agent1/';
        $directory = Yii::getAlias('@frontend'.$path);
        FileHelper::createDirectory($directory,0777);

        $file = $directory.md5($address);
        if (file_exists($file)) {
            if ((time() - filemtime($file)) > 20) {
                $pre = 'http://api.hclyz.cn:81/mf/';
                try {
                    $response = CurlHelper::curlGet($pre.$address);
                    if ($response) {
                        file_put_contents($file,$response);
                        return $response;
                    }else{
                        $contents = file_get_contents($file);
                        return $contents;
                    }
                } catch (\Exception $e) {
                    $contents = file_get_contents($file);
                    return $contents;
                }
            }else{
                $contents = file_get_contents($file);
                return $contents;
            }
        }else{
            $pre = 'http://api.hclyz.cn:81/mf/';
            try {
                $response = CurlHelper::curlGet($pre.$address);
                if ($response) {
                    file_put_contents($file,$response);
                    return $response;
                }else{
                    return '';
                }
            } catch (\Exception $e) {
                return '';
            }
        }
    }

    public static function agent2($address)
    {
        $path = '/web/agent2/';
        $directory = Yii::getAlias('@frontend'.$path);
        FileHelper::createDirectory($directory,0777);

        $file = $directory.md5($address);
        if (file_exists($file)) {
            if ((time() - filemtime($file)) > 20) {
                $pre = 'http://106.12.37.32/apiht.php?name=';
                try {
                    $response = CurlHelper::curlGet($pre.$address);
                    if ($response) {
                        if ($address == 'list') {
                            file_put_contents($file,$response);
                            return $response;
                        }else{
                            //因为返回内容跟第一个接口不一样，所以要转换字段数据
                            $responseArray = json_decode($response,true);
                            $newResponseArray = [];
                            $newResponseArray['zhubo'] = $responseArray['pingtai'];
                            foreach ($newResponseArray['zhubo'] as $key => &$value) {
                                $value['img'] = $value['xinimg'];
                                unset($value['xinimg']);
                            }
                            $newResponse = json_encode($newResponseArray);
                            file_put_contents($file,$newResponse);
                            return $newResponse;
                        }
                    }else{
                        $contents = file_get_contents($file);
                        return $contents;
                    }
                } catch (\Exception $e) {
                    $contents = file_get_contents($file);
                    return $contents;
                }
            }else{
                $contents = file_get_contents($file);
                return $contents;
            }
        }else{
            $pre = 'http://106.12.37.32/apiht.php?name=';
            try {
                $response = CurlHelper::curlGet($pre.$address);
                if ($response) {
                    if ($address == 'list') {
                        file_put_contents($file,$response);
                        return $response;
                    }else{
                        //因为返回内容跟第一个接口不一样，所以要转换字段数据
                        $responseArray = json_decode($response,true);
                        $newResponseArray = [];
                        $newResponseArray['zhubo'] = $responseArray['pingtai'];
                        foreach ($newResponseArray['zhubo'] as $key => &$value) {
                            $value['img'] = $value['xinimg'];
                            unset($value['xinimg']);
                        }
                        $newResponse = json_encode($newResponseArray);
                        file_put_contents($file,$newResponse);
                        return $newResponse;
                    }
                }else{
                    return '';
                }
            } catch (\Exception $e) {
                return '';
            }
        }
    }

    public static function agent3($address)
    {
        $path = '/web/agent3/';
        $directory = Yii::getAlias('@frontend'.$path);
        FileHelper::createDirectory($directory,0777);

        $file = $directory.md5($address);
        if (file_exists($file)) {
            if ((time() - filemtime($file)) > 20) {
                $pre = 'http://07cctv.com/jiekubumf/';
                try {
                    $response = CurlHelper::curlGet($pre.$address.'.txt');
                    if ($response) {
                        if ($address == '07') {
                            $newResponse = '';
                            $newResponse = self::agent3FormatPlant($response);
                            file_put_contents($file,$newResponse);
                            return $newResponse;
                        }else{
                            $newResponse = '';
                            $newResponse = self::agent3FormatList($response);
                            file_put_contents($file,$newResponse);
                            return $newResponse;
                        }
                    }else{
                        $contents = file_get_contents($file);
                        return $contents;
                    }
                } catch (\Exception $e) {
                    $contents = file_get_contents($file);
                    return $contents;
                }
            }else{
                $contents = file_get_contents($file);
                return $contents;
            }
        }else{
            $pre = 'http://07cctv.com/jiekubumf/';
            try {
                $response = CurlHelper::curlGet($pre.$address.'.txt');
                if ($response) {
                    if ($address == '07') {
                        $newResponse = '';
                        $newResponse = self::agent3FormatPlant($response);
                        file_put_contents($file,$newResponse);
                        return $newResponse;
                    }else{
                        $newResponse = '';
                        $newResponse = self::agent3FormatList($response);
                        file_put_contents($file,$newResponse);
                        return $newResponse;
                    }
                }else{
                    return '';
                }
            } catch (\Exception $e) {
                return '';
            }
        }
    }

    public static function agent3FormatPlant($response)
    {
        $newResponse = '';
        $newResponseArray = [];
        $newResponseArray['pingtai'] = [];

        //转换编码，原编码为GBK
        $response = iconv('GBK', 'utf-8', $response);
        $len = mb_strlen($response);
        $start = mb_strpos($response, 'm');
        $allPlants = mb_substr($response, $start,$len-$start,'utf-8');
        $allPlantsArray = explode('|', $allPlants);
        if (is_array($allPlantsArray)) {
            foreach ($allPlantsArray as $key => $value) {
                $value = str_replace('sl', '', str_replace('dz', '', str_replace('mz@', '', $value)));
                $valueArray = explode('@', $value);
                if (isset($valueArray[0]) && $valueArray[0] && isset($valueArray[1]) && $valueArray[1] && isset($valueArray[2]) && $valueArray[2] && isset($valueArray[3]) && $valueArray[3]) {
                    $temp['address'] = $valueArray[3];
                    $temp['xinimg'] = $valueArray[1];
                    $temp['Number'] = $valueArray[2];
                    $temp['title'] = $valueArray[0];
                    $newResponseArray['pingtai'][] = $temp;
                }else{
                    continue;
                }
            }
        }
        $newResponse = json_encode($newResponseArray);
        return $newResponse;
    }

    public static function agent3FormatList($response)
    {
        $newResponse = '';
        $newResponseArray = [];
        $newResponseArray['zhubo'] = [];

        //转换编码，原编码为GBK
        $response = iconv('GBK', 'utf-8', $response);
        $len = mb_strlen($response);
        $start = mb_strpos($response, 'm');
        $allPlants = mb_substr($response, $start,$len-$start,'utf-8');
        $allPlantsArray = explode('|', $allPlants);
        if (is_array($allPlantsArray)) {
            foreach ($allPlantsArray as $key => $value) {
                $value = str_replace('dz', '', str_replace('mz@', '', $value));
                $valueArray = explode('@', $value);
                if (isset($valueArray[0]) && $valueArray[0] && isset($valueArray[1]) && $valueArray[1] && isset($valueArray[2]) && $valueArray[2]) {
                    $temp['address'] = $valueArray[2];
                    $temp['img'] = explode('?', $valueArray[1])[0];
                    $temp['title'] = str_replace('tp', '', $valueArray[0]);
                    $newResponseArray['zhubo'][] = $temp;
                }else{
                    continue;
                }
            }
        }
        $newResponse = json_encode($newResponseArray);
        return $newResponse;
    }

    public static function agent1_bak($address)
    {
        $path = '/web/zb1/';
        $directory = Yii::getAlias('@frontend'.$path);

        $file = $directory.$address;
        if (file_exists($file)) {
            $contents = file_get_contents($file);
            return $contents;
        }else{
            return '';
        }
    }
}
