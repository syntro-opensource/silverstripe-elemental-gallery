# Swiper Configuration

The module provides a default swiper build which you can import
via:

```
<% require javascript('syntro/silverstripe-elemental-slider:client/dist/main.js') %>
<% require css('syntro/silverstripe-elemental-slider:client/dist/bundle.css') %>
```

The swiper build from this module will automatically attach to
a swiper HTML layout with an `data-swiper` attribute. It will expect
the swiper config as a JSON string in this attribute. You can use
this in a template of any `Swiper` block like so:

```html
<div class="swiper" data-slider="$Swiper" data-slider-config='{"loop": true, "autoplay": {"delay": 5000}}'>
  <!-- Additional required wrapper -->
  <div class="swiper-wrapper">
    <!-- Slides -->
    <% loop Slides %>
        <div class="swiper-slide">
            <img src="$Image.Fill(1920,1080).URL" alt="$Title" class="img-fluid">
        </div>
    <% end_loop %>
</div>
```

by using the `data-slider-config` attribute, you can add a template
specific config (i.e. breakpoints for cards).

## Swiper Config on Block
You can extend the `updateSwiperConfig` hook on any `Swiper` block
to update the rendered config:
```php
public function updateSwiperConfig($config)
{
    $array['loop'] = true;
}
```
