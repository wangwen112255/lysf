<?php
/**
 * Created by mumu.
 * Date: 2016/11/24
 * Time: 17:05
 */
return array(
    /**
     * Debug 模式，bool 值：true/false
     *
     * 当值为 false 时，所有的日志都不会记录
     */
    'debug'  => true,
    /**
     * 账号基本信息，请从微信公众平台/开放平台获取
     */
    'app_id'  => 'wx9fa9d26c0a9dbb3e',         // AppID
    'secret'  => '1a0465c2dee0770c272edc33ff89a3aa',     // AppSecret
    'token'   => 'yxt',          // Token
    'aes_key' => 'lORNdRUXtWejgbKbIKLWezI9MIkt5wDFuTa3iJrbcWj',                    // EncodingAESKey，安全模式下请一定要填写！！！
    /**
     * 日志配置
     *
     * level: 日志级别, 可选为：
     *         debug/info/notice/warning/error/critical/alert/emergency
     * file：日志文件位置(绝对路径!!!)，要求可写权限
     */
    'log' => [
        'level' => 'debug',
        'file'  => '/tmp/easywechat.log',
    ],
    /**
     * OAuth 配置
     *
     * scopes：公众平台（snsapi_userinfo / snsapi_base），开放平台：snsapi_login
     * callback：OAuth授权完成后的回调页地址
     */
    'oauth' => [
        'scopes'   => ['snsapi_base'],
        'callback' => 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'],
    ],
    /**
     * 微信支付
     */
    'payment' => [
        'merchant_id'        => '1416989702',
        'key'                => 'BduGP1PquGIZyutA6LHys6fhIwlx18Z0',
        'cert_path'          => '/cert/apiclient_cert.pem', // XXX: 绝对路径！！！！
        'key_path'           => '/cert/apiclient_key.pem',      // XXX: 绝对路径！！！！
//        'sub_merchant_id'    => '1416989702',
        // 'device_info'     => '013467007045764',
        // 'sub_app_id'      => '',
        // ...
    ],
    /**
     * Guzzle 全局设置
     *
     * 更多请参考： http://docs.guzzlephp.org/en/latest/request-options.html
     */
    'guzzle' => [
        'timeout' => 3.0, // 超时时间（秒）
        //'verify' => false, // 关掉 SSL 认证（强烈不建议！！！）
    ],
);