<?php

namespace ArnoPoot\MetaKeywords;


use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Core\Convert;
use SilverStripe\Forms\CompositeField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextareaField;
use SilverStripe\ORM\DataExtension;


class MetaKeywordsExtension extends DataExtension
{

    private static $db = [
        'MetaKeywords' => 'Varchar(1024)',
    ];

    public function updateCMSFields(FieldList $fields)
    {
        /** @var CompositeField $metaData */
        $metaData = $fields->fieldByName('Root.Main.Metadata');

        $metaFieldTitle = new TextareaField('MetaKeywords', $this->owner->fieldLabel('MetaKeywords'));
        $metaData->insertAfter('MetaDescription', $metaFieldTitle);

        return $fields;
    }

    public function updateFieldLabels(&$labels)
    {
        $labels['MetaKeywords'] = _t(SiteTree::class . 'METAKEYWORDS', 'Meta Keywords');
    }

    public function MetaTags(&$tags)
    {
        if ($this->owner->MetaKeywords) {
            $tags .= '<meta name="keywords" content="' . Convert::raw2att($this->owner->MetaKeywords) . "\" />\n";
        }
    }

}
