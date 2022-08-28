<?php

namespace Syntro\SilverstripeElementalSlider\Interfaces;

/**
 * Implements functions necessary for swiper config
 *
 * @author Matthias Leutenegger <hello@syntro.ch>
 */
interface Swiper
{
    /**
     * return the swiper config as JSON
     *
     * @return string
     */
    public function getSwiper(): string;
}
