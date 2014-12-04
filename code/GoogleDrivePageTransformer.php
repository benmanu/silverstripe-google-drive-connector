<?php
class GoogleDrivePageTransformer implements ExternalContentTransformer {

	/**
	 * Transforms a given item, creating a new object underneath
	 * the parent object.
	 * 
	 * @param $item
	 * 			The object to transform
	 * @param $parentObject
	 * 			The object to create any new pages underneath
	 * @param $duplicateStrategy
	 * 			How to handle duplicates when importing
	 * 
	 * @return TransformResult
	 * 			The new page
	 */
	public function transform($item, $parentObject, $duplicateStrategy) {
		$includeParent = $duplicateStrategy;

		// google drive file id
		$fileID = $item->FileID;

		// create or use the parent page
		$page = ($includeParent ? $parentObject : new Page());

		$page->Title = 'test';
		$page->Status = 'Published';
		$page->Content = '<p>Test</p>';

		$page->ParentID = ($includeParent ? $parentObject->ParentID : $parentObject->ID);
		
		Versioned::reading_stage('Stage');
		$page->write();
		$page->publish('Stage', 'Live');

		return new TransformResult($page, null);
	}
}