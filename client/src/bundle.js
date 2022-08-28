import Swiper from 'swiper/bundle'; // eslint-disable-line import/no-unresolved

import './style.scss';

(function initSwiper() {
  const swipers = document.querySelectorAll('[data-slider]');
  const items = [];
  swipers.forEach((item) => {
    const configString = item.dataset.slider;
    const addConfigString = item.dataset.sliderConfig;
    if (configString && configString !== '') {
      const config = JSON.parse(configString);
      let addConfig = {};
      if (addConfigString && addConfigString !== '') {
        addConfig = JSON.parse(addConfigString);
      }
      const swiperItem = new Swiper(item, {
        ...config,
        ...addConfig,
        // additional config would go here, but config
      });
      items.push(swiperItem);
    }
  });
  return items;
}());
