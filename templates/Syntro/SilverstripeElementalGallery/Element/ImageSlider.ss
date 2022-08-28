<% require javascript('syntro/silverstripe-elemental-gallery:client/dist/main.js') %>
<% require css('syntro/silverstripe-elemental-gallery:client/dist/bundle.css') %>
<div class="container">
    <!-- Slider main container -->
    <div class="swiper" data-slider="$Swiper" data-slider-config='{"loop": true, "autoplay": {"delay": 5000}}'>
      <!-- Additional required wrapper -->
      <div class="swiper-wrapper">
        <!-- Slides -->
        <% loop Slides %>
            <div class="swiper-slide">
                <img src="$Image.Fill(1920,1080).URL" alt="$Title" class="img-fluid">
            </div>
        <% end_loop %>
        <%-- <div class="swiper-slide" style="height: 200px; background-color:rgb(202, 218, 113)">Slide 1</div>
        <div class="swiper-slide" style="height: 200px; background-color:rgb(209, 147, 196)">Slide 2</div>
        <div class="swiper-slide" style="height: 200px; background-color:rgb(182, 226, 151)">Slide 3</div> --%>
      </div>
      <!-- If we need pagination -->
      <%-- <div class="swiper-pagination"></div> --%>

      <!-- If we need navigation buttons -->
      <%-- <div class="swiper-button-prev"></div> --%>
      <%-- <div class="swiper-button-next"></div> --%>

      <!-- If we need scrollbar -->
      <%-- <div class="swiper-scrollbar"></div> --%>
    </div>

</div>
