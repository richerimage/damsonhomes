<?php 


    if( $_GET['tab'] == 'gallery' ) 
    {
        ?>
        <script type="text/html" id="tmpl-custom-gallery-setting">

    <label class="setting">
        <span>Gallery Type</span>
        <select name="type" data-setting="type" onchange="getval(this);">
            <option value="default">Default</option>
            <option value="masonry">Masonry</option>
            <option value="slider">Slider</option>
        </select>
    </label>

<div id="slider-settings">
    <label class="setting">
        <span>Animation</span>
        <select id="gallery-type" name="animation" data-settings="animation">
            <option value=""></option>
            <option value="fade">Fade</option>
            <option value="slide">Slide</option>
        </select>
    </label>
</div>

</script>

<script>

    jQuery(document).ready(function() {

        wp.media.view.Settings.Gallery = wp.media.view.Settings.Gallery.extend({
        template: function(view){
          return wp.media.template('gallery-settings')(view)
               + wp.media.template('custom-gallery-setting')(view);
        }
        });
    });

</script>
        <?php
    }


