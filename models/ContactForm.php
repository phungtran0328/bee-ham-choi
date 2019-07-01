<?php

namespace app\models;

use himiklab\yii2\recaptcha\ReCaptchaValidator2;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model{

	public $guest_name;
	public $guest_email;
	public $subject;
	public $content;
	public $verifyCode;


	/**
	 * @return array the validation rules.
	 */
	public function rules(){
		return [
			[['guest_name', 'guest_email', 'subject', 'content',], 'required'],
			['guest_email', 'email'],
			['verifyCode', ReCaptchaValidator2::class,
				'uncheckedMessage' => 'Please confirm that you are not a bot.'],
		];
	}

	/**
	 * @return array customized attribute labels
	 */
	public function attributeLabels(){
		return [
			'guest_name'  => 'Name',
			'guest_email' => 'Email',
			'subject'     => 'Subject',
			'content'     => 'Content',
			'verifyCode'  => 'Verification',
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
		$contact_model->guest_name  = $this->guest_name;
		$contact_model->guest_email = $this->guest_email;
		$contact_model->subject     = $this->subject;
		$contact_model->content     = $this->content;
		if ($contact_model->save()){
			return TRUE;
		}

		return FALSE;
	}
}