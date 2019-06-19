<?php
namespace Shenghuo\request;

/**
 * author:czk
 * time:2019-06-18
 */
class ShSdkApi1 extends ShSdkBase
{
	
	public function __construct($config,$data)
	{
		parent::__construct($config,$data);
	}

	/**
	 * 注册
	 */
	public function userRegister(){
		$data = $this->values;
		// 密码加密
		$encryPsd = $this->encryption($data['password']);
		if ($encryPsd['code']==FAIL) {
			return $encryPsd;
		}
		$data['password'] = $encryPsd['data'];
		// 密码加密
		$encryPyd = $this->encryption($data['payword']);
		if ($encryPyd['code']==FAIL) {
			return $encryPyd;
		}
		$data['payword'] = $encryPyd['data'];
		// 生成签名串
		$data['sign'] = $this->MakeSign();
		p($data);
		// 请求会员管理系统接口
		$url = API_HOST.REGISTER;
		$res = https_request($url, 'POST', $data);
		return $res;
	}

	/**
	 * 用户登录
	 */
	public function userLogin(){
		$data = $this->values;
		// 密码加密
		$encryPsd = $this->encryption($data['password']);
		if ($encryPsd['code']==FAIL) {
			return $encryPsd;
		}
		$data['password'] = $encryPsd['data'];
		// 生成签名串
		$data['sign'] = $this->MakeSign();
		p($data);
		// 请求会员管理系统接口
		$url = API_HOST.LOGIN;
		$res = https_request($url, 'POST', $data);
		return $res;

	}

	/**
	 * 通用接口
	 */
	public function commonInterface($interfaceName){
		$data = $this->values;
		// 生成签名串
		$data['sign'] = $this->MakeSign();
		p($data);
		// 请求会员管理系统接口
		$url = API_HOST.$interfaceName;
		$res = https_request($url, 'POST', $data);
		return $res;
	}

	

	public function test(){
		$data['code'] = 0;
		$data['data'] = '123123';
		// return resultArray($data);
		// var_dump($config);
		var_dump($this->appId);
		var_dump($this->appKey);
		echo "string123123";
	}
}