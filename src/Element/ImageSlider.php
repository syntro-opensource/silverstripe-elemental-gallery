<?php

namespace Syntro\SilverstripeElementalSlider\Element;

use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Assets\Image;
use DNADesign\Elemental\Models\BaseElement;
use Syntro\SilverStripeElementalBaseitem\Forms\GridFieldConfig_ElementalChildren;
use Syntro\SilverstripeElementalSlider\Element\ImageSlide;
use Syntro\SilverstripeElementalSlider\Interfaces\Swiper;

/**
 * An element which renders a Slider.
 *
 * @author Matthias Leutenegger
 */
class ImageSlider extends BaseElement implements Swiper
{
    /**
     * Defines the database table name
     * @config
     * @var string
     */
    private static $table_name = 'BlockImageSlider';

    /**
     * Singular name for CMS
     * @config
     * @var string
     */
    private static $singular_name = 'Image Slider';

    /**
     * Plural name for CMS
     * @config
     * @var string
     */
    private static $plural_name = 'Image Sliders';

    /**
     * @config
     * @var bool
     */
    private static $inline_editable = false;

    /**
     * Display a show title button
     *
     * @config
     * @var boolean
     */
    private static $displays_title_in_template = false;

    /**
     * @config
     * @var bool
     */
    private static $allow_title_customization = false;

    /**
     * @config
     * @var string
     */
    private static $icon = 'font-icon-block-carousel';


    /**
     * available styles
     * @config
     * @var array
     */
    private static $styles = [];

    /**
     * Database fields
     * @config
     * @var array
     */
    private static $db = [
        'Autoplay' => 'Boolean'
    ];

    /**
     * Add default values to database
     * @config
     * @var array
     */
    private static $defaults = [
        'Autoplay' => true
    ];

    /**
     * Has_one relationship
     * @config
     * @var array
     */
    private static $has_one = [];

    /**
     * Has_many relationship
     * @config
     * @var array
     */
    private static $has_many = [
        'Slides' => ImageSlide::class,
    ];

    /**
     * Relationship version ownership
     * @config
     * @var array
     */
    private static $owns = [
        'Slides'
    ];

    /**
     * CMS Fields
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        if ($this->ID) {
            /** @var GridField $griditems */
            $griditems = $fields->fieldByName('Root.Slides.Slides');
            $griditems->setConfig(GridFieldConfig_ElementalChildren::create());
            $fields->removeByName([
                'Slides',
                'Autoplay',
                'Root.Slides.Slides'
            ]);
            $fields->addFieldToTab(
                'Root.Main',
                $griditems
            );
        } else {
            $fields->removeByName([
                'Slides',
                'Autoplay',
                'Root.Slides.Slides'
            ]);
        }
        $fields->addFieldToTab(
            'Root.Settings',
            $autoplayField = CheckboxField::create(
                'Autoplay',
                _t(__CLASS__ . '.AUTOPLAYTITLE', 'Enable autoplay')
            ),
            'ExtraClass'
        );
        return $fields;
    }

    /**
     * getType
     *
     * @return string
     */
    public function getType()
    {
        return _t(__CLASS__ . '.BlockType', 'Image Slider');
    }

    /**
     * @return array
     */
    protected function provideBlockSchema()
    {
        $blockSchema = parent::provideBlockSchema();
        $slides = $this->Slides();
        $blockSchema['content'] = _t(__CLASS__ . '.BlockSummary', '{count} slides', ['count' => $slides->count()]);
        return $blockSchema;
    }

    /**
     * Renders the swiper config for passing it to the slider
     *
     * @return string
     */
    public function getSwiper(): string
    {
        $config = [
            'elementId' => $this->ID
        ];
        $this->extend('updateSwiperConfig', $config);
        return json_encode($config);
    }
}
