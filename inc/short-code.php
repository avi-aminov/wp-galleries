<?php

/** ShortCode */
function show_gallery_func($atts) {

    $default = array(
        'name' => '',
        'size' => 'medium-gallery',
    );

    $param = shortcode_atts($default, $atts);

    /** get gallery post by name (slug) */
    $post = Helper::get_gallery_post_by_slug($param['name']);
    if(!$post) return;

    /** get images (gallery_data field) by post id */
    $images = get_post_field('gallery_data', $post->ID);

    /** random uniq id for etch carousel */
    $uniq_id = Helper::generateRandomString();

    /** set carousel maximum width  */
    $max_width = $param['size'] == 'medium-gallery' ? 640 : 250;

    $carousel_Indicators = '';
    $carousel_items = '';

    /** preparat carousel items and indicators */
    $index = 0;
    if(isset($images['image_url'])){
        foreach ($images['image_url'] as $image){
            $img_id = attachment_url_to_postid( $image);
            $medium = wp_get_attachment_image_src( $img_id, $param['size'] );

            if($index == 0){
                $carousel_Indicators .= '<button type="button" data-bs-target="#wpGalleriesIndicators-'.$uniq_id.'" data-bs-slide-to="'.$index.'" class="active" aria-current="true" aria-label="Slide '.($index + 1).'"></button>';
            }else{
                $carousel_Indicators .= '<button type="button" data-bs-target="#wpGalleriesIndicators-'.$uniq_id.'" data-bs-slide-to="'.$index.'" aria-label="Slide '.($index + 1).'"></button>';
            }

            $carousel_items .= '<div class="carousel-item '.($index == 0 ? " active " : "").'">';
            $carousel_items .= '<img src="'.$medium[0].'" class="d-block w-100" alt="Slide image">';
            $carousel_items .= '</div>';

            $index++;
        }
    }

    $next = __('Next', 'wp-galleries');
    $previous = __('Previous', 'wp-galleries');

    /** preparat carousel html */
    $carousel = <<<HTML
    <div style="max-width: {$max_width}px;" id="wpGalleriesIndicators-{$uniq_id}" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            {$carousel_Indicators}
        </div>
        <div class="carousel-inner">    
            {$carousel_items}
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#wpGalleriesIndicators-{$uniq_id}" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">{$previous}</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#wpGalleriesIndicators-{$uniq_id}" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">{$next}</span>
        </button>
    </div>
HTML;

    return $carousel;
}