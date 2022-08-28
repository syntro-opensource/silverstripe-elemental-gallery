<?php

namespace Syntro\SilverstripeElementalSlider\Element;

use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Assets\Image;
use SilverStripe\AssetAdmin\Forms\UploadField;
use Syntro\SilverStripeElementalBaseitem\Model\BaseItem;
use SilverStripe\ORM\ValidationResult;
// use gorriecoe\Link\Models\Link;
// use gorriecoe\LinkField\LinkField;
use Syntro\SilverstripeElementalSlider\Element\ImageSlider;

/**
 * A carousel slide
 * @author Matthias Leutenegger <hello@syntro.ch>
 */
class ImageSlide extends BaseItem
{
    /**
     * Defines the database table name
     * @config
     * @var string
     */
    private static $table_name = 'BlockSlider_ImageSlide';

    /**
     * @config
     * @var boolean
     */
    private static $displays_title_in_template = false;

    /**
     * @config
     * @var array
     */
    private static $db = [];

    /**
     * Add default values to database
     * @config
     * @var array
     */
    private static $defaults = [];

    /**
     * @config
     * @var array
     */
    private static $has_one = [
        'Section' => ImageSlider::class,
        'Image' => Image::class,
        // 'Link' => Link::class
    ];

    /**
     * duplicate relations
     * @config
     * @var array
     */
    private static $cascade_duplicates = [
        // 'Link'
    ];


    /**
     * Defines summary fields commonly used in table columns
     * as a quick overview of the data for this dataobject
     * @var array
     */
    private static $summary_fields = [
        'Image.StripThumbnail' => 'Image',
        'Title' => 'Title'
    ];

    /**
     * Relationship version ownership
     * @var array
     */
    private static $owns = [
        'Image',
        // 'Link'
    ];

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        // $contentField = $fields->fieldByName('Root.Main.Content');
        // $contentField->setTitle(_t(__CLASS__ . '.CONTENTTITLE', 'Content'));

        $titleField = $fields->fieldByName('Root.Main.Title');
        $titleField->setTitle(_t(__CLASS__ . '.TITLETITLE', 'Alt Text'));
        $titleField->setDescription(_t(__CLASS__ . '.TITLEDESC',
            "
                Alternative text in case the image cannot be loaded or for screen readers.
                Should describe the image as best as possible.
            "
        ));

        $fields->removeByName([
            'SectionID',
            'LinkID'
        ]);

        $fields->addFieldToTab(
            'Root.Main',
            $imageField = UploadField::create(
                'Image',
                _t(__CLASS__ . '.IMAGETITLE', 'Image')
            ),
            'Title'
        );
        $imageField->setFolderName('Elements/Slider');
        $imageField->setAllowedMaxFileNumber(1);
        $imageField->setAllowedExtensions(['png','jpg','jpeg']);

        // $fields->addFieldToTab(
        //     'Root.Main',
        //     LinkField::create(
        //         'Link',
        //         _t(__CLASS__ . '.LINKTITLE', 'Link'),
        //         $this
        //     )
        // );

        return $fields;
    }

    /**
     * validate - validates the object
     *
     * @return ValidationResult
     */
    public function validate()
    {
        $result = parent::validate();
        if (!$this->Title) {
            $result->addFieldError('Title', _t(__CLASS__ . '.NOTITLE', 'Please insert an alt text.'));
        }
        return $result;
    }
}
