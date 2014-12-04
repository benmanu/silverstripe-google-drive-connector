<?php
class GoogleDriveImporter extends ExternalContentImporter {
	
	/**
	 * @return void
	 */
	public function __construct() {
		$this->contentTransforms['sitetree'] = new GoogleDrivePageTransformer();
	}

	/**
	 * @param GoogleDriveContentSource $item
	 * @return string
	 */
	public function getExternalType($item) {
		return $item->getType();
	}

	/**
	 * Import from a content source to a particular target
	 *  
	 * @param GoogleDriveContentSource $contentItem
	 * @param SiteTree $target
	 * @param boolean $includeParent
	 * 			Whether to include the selected item in the import or not
	 * @param String $duplicateStrategy
	 * 			How to handle duplication 
	 * @param array $params All parameters passed with the import request.
	 */
	public function import($contentItem, $target, $includeParent = false, $includeChildren = true, $duplicateStrategy='Overwrite', $params = array()) {
		$pageType = 'sitetree';
		if(isset($this->contentTransforms[$pageType])) {
			$transformer = $this->contentTransforms[$pageType];
			$result = $transformer->transform($contentItem, $target, $includeParent);
		}
	}

}
