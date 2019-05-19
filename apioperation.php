<?php

class APIlib{

    function enableCors(){
         if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
         }

         // Access-Control headers are received during OPTIONS requests
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
                 header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
                 header("Access-Control-Allow-Headers:        
                 {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

             exit(0);
            }
            return true;
     }

     function getRequestCurl($url){
         $ch = curl_init();
         curl_setopt($ch, CURLOPT_URL, $url);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
         curl_setopt($ch, CURLOPT_HEADER, 0);
         $output = curl_exec($ch);
         curl_close($ch);
         return $output;
     }

     function postRequestCurl($url, $dataArray){
         $curl = curl_init();
         curl_setopt($curl, CURLOPT_URL, $url);
         curl_setopt($curl, CURLOPT_HEADER, 1);
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
         curl_setopt($curl, CURLOPT_POST, 1);
         $post_data = $dataArray;
         curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
         $data = curl_exec($curl);
         curl_close($curl);
         return $data;
     }

    /**
     * PHP发送Json对象数据
     *
     * @param $url 请求url
     * @param $jsonStr 发送的json字符串
     * @return array
     */
    function httpPostJson($url,$json,$timeout)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, 1);
        //The number of seconds to wait while trying to connect. Use 0 to wait indefinitely.
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);//用来告诉PHP脚本在成功连接服务器前等待多久（连接成功之后就会开始缓冲输出），这个参数是为了应对目标服务器的过载，下线，或者崩溃等可能状况；
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);//用来告诉成功PHP脚本，从服务器接收缓冲完成前需要等待多长时间。如果目标是个巨大的文件，生成内容速度过慢或者链路速度过慢，这个参数就会很有用。
        // 自动设置Referer
        // curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }


}


