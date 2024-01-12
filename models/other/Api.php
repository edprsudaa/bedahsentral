<?php
namespace app\models\other;
class Api
{
    public function writeResponse($condition, $msg = null, $data = null)
	{
		$_res = new \stdClass();
		$_res->con = $condition == true ? true : false;
		$_res->msg = $msg;
		$_res->data = $data;
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		return $_res;
	}
}
?>