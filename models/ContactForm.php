<?php

namespace app\models;

use himiklab\yii2\recaptcha\ReCaptchaValidator2;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model{

	public $name;
	public $email;
	public $subject;
	public $body;
	public $verifyCode;


	/**
	 * @return array the validation rules.
	 */
	public function rules(){
		return [
			[['name', 'email', 'subject', 'body',], 'required'],
			['email', 'email'],
			['verifyCode', 'required', 'message' => 'Please confirm that you are not a bot.'],
			['verifyCode', ReCaptchaValidator2::class,],
		];
	}

	/**
	 * @return array customized attribute labels
	 */
	public function attributeLabels(){
		return [
			'verifyCode' => 'Verification',
		];
	}

	/**
	 * @return bool
	 */
	public function contactMe(){
		if (!$this->validate()){
			return FALSE;
		}
		$contact_model              = new Contact();
		$contact_model->guest_name  = $this->name;
		$contact_model->guest_email = $this->email;
		$contact_model->subject     = $this->subject;
		$contact_model->content     = $this->body;
		if ($contact_model->save()){
			return TRUE;
		}

		return FALSE;
	}
}
