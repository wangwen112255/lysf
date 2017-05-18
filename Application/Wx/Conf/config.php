<?php
return array(
	//'配置项'=>'配置值'
    'LOAD_EXT_CONFIG' => array('WX'=>'wx'),
    'TMPL_ACTION_ERROR'     =>  THINK_PATH.'Tpl/wx_dispatch_jump.tpl', // 默认错误跳转对应的模板文件
    'TMPL_ACTION_SUCCESS'   =>  THINK_PATH.'Tpl/wx_dispatch_jump.tpl', // 默认成功跳转对应的模板文件
    'TMPL_EXCEPTION_FILE'   =>  THINK_PATH.'Tpl/think_exception.tpl',// 异常页面的模板文件
);