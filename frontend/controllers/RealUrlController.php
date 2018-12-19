<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\helpers\CurlHelper;

class RealUrlController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        $url = Yii::$app->request->post('a');
        if (strstr($url,'rtmp://')) {
            return json_encode(['address' => $url]);
        }
        if (strstr($url,'http://t.cn')) {
            $cache = Yii::$app->cache->get(md5($url));
            if ($cache) {
                return json_encode(['address' => $cache]);
            }else{
                try {
                    $response = $this->sinaExpandUrl($url);
                    if ($response) {
                        $responseArray = json_decode($response,true);
                        if (is_array($responseArray)) {
                            $realUrl = $responseArray[0]['url_long'];
                            Yii::$app->cache->set(md5($url),$realUrl,3600);
                            return json_encode(['address' => $realUrl]);
                        }
                    }
                } catch (\Exception $e) {
                    return json_encode(['address' => $url]);
                }
                return json_encode(['address' => $url]);
            }
        }
        return json_encode(['address' => $url]);
    }

    public static function sinaExpandUrl($shortUrl)
    {
        //拼接请求地址，此地址你可以在官方的文档中查看到
        $u = 'http://api.t.sina.com.cn/short_url/expand.json?source=930414781&url_short='.$shortUrl;
        //获取请求结果
        $result = CurlHelper::curlGet($u);
        return $result;
    }

    public static function getLongUrl($shortUrl)
    {
        if (strstr($shortUrl,'rtmp://')) {
            return $shortUrl;
        }
        if (strstr($shortUrl,'http://t.cn')) {
            $cache = Yii::$app->cache->get(md5($shortUrl));
            if ($cache) {
                return $cache;
            }else{
                try {
                    $response = self::sinaExpandUrl($shortUrl);
                    if ($response) {
                        $responseArray = json_decode($response,true);
                        if (is_array($responseArray)) {
                            $realUrl = $responseArray[0]['url_long'];
                            Yii::$app->cache->set(md5($shortUrl),$realUrl,3600);
                            return $realUrl;
                        }
                    }
                } catch (\Exception $e) {
                    return $shortUrl;
                }
                return $shortUrl;
            }
        }
    }
}
