<?php
// this class used in https://esachello.com

class SweetAlert extends CApplicationComponent {
	public function themePath()
	{
		return Yii::app()->theme->baseUrl.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR;
	}
	public function showAlert($type=null)
	{
		$title=null;
		$text=null;
		$confirmButtonText=null;
		$redirect=0;
		if($type)
		{
			switch ($type)
			{
				case 'success':
					$title=Yii::t('alert','Thanks');
					$text=Yii::t('alert','We will certainly contact you!');
					$confirmButtonText=Yii::t('alert','OK');
					$redirect=1;
				break;
				case 'warning':
					$title=Yii::t('alert','Warning');
					$text=Yii::t('alert','Fill, please, all fields of this form.');
					$confirmButtonText=Yii::t('alert','Good');
				break;
			}
			$cs=Yii::app()->clientScript;
			$cs->registerCssFile($this->themePath().'css/sweet-alert.css');
			$cs->registerScriptFile($this->themePath().'js/sweet-alert.min.js', CClientScript::POS_END);
			$cs->registerScript('alertswall','
				sweetAlertInitialize();
				swal(
					{
						title: "'.$title.'",
						text: "'.$text.'\n\n",
						type: "'.$type.'",
						confirmButtonText: "'.$confirmButtonText.'"
					},
					function(isConfirm)
					{
						if('.$redirect.')
						{
							if (isConfirm) {
								setTimeout(
								window.location = "'.Yii::app()->getBaseUrl(true).'"
								, 2000);
							}
						}
					}
				);
			', CClientScript::POS_END);
		}
	}
}
?>
