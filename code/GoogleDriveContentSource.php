<?php
class GoogleDriveContentSource extends ExternalContentSource {

	public static $db = array(
		'FileID' => 'Varchar(255)'
	);
	
	public function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->addFieldToTab('Root.Main', new TextField('FileID', 'File ID'));
		return $fields;
	}

	public function getContentImporter($target=null) {
		return new GoogleDriveImporter();
	}

	public function allowedImportTargets() {
		return array('sitetree' => true);
	}

}