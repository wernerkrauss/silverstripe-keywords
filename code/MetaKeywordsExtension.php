<?php

class MetaKeywordsExtension extends DataExtension {

	private static $db = array(
		"MetaKeywords" => "Varchar(1024)",
	);

	public function updateCMSFields(FieldList $fields) {
		$metaData = $fields->fieldByName('Root.Main.Metadata');

		$metaFieldTitle = new TextareaField("MetaKeywords", $this->owner->fieldLabel('MetaKeywords'));
		$metaData->insertAfter($metaFieldTitle, 'MetaDescription');

		return $fields;
	}

	public function updateFieldLabels(&$labels) {
		$labels['MetaKeywords'] = _t('SiteTree.METAKEYWORDS', "Meta Keywords");
	}

	public function MetaTags(&$tags) {
		if($this->owner->MetaKeywords) {
			$tags .= "<meta name=\"keywords\" content=\"" . Convert::raw2att($this->owner->MetaKeywords) . "\" />\n";
		}
	}

}