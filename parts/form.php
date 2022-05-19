<?php
    global $post;
    $gallery_data = get_post_meta( $post->ID, 'gallery_data', true );
?>

<div id="wp-galleries-form">
    <div id="field_wrap">
        <?php
        if ( isset( $gallery_data['image_url'] ) ) {
            for( $i = 0; $i < count( $gallery_data['image_url'] ); $i++ ){
            ?>
            <div class="field_row">

                <div class="field_left">
                    <div class="form_field">
                        <label>Image URL</label>
                        <input type="text" class="meta_image_url" name="gallery[image_url][]"
                               value="<?php esc_html_e( $gallery_data['image_url'][$i] ); ?>" />
                    </div>
                </div>

                <div class="field_right">
                    <input class="button" type="button" value="Choose Image" onclick="Galleries.addImage(this)" /><br />
                    <input class="button" type="button" value="Remove Image" onclick="Galleries.removeField(this)" />
                </div>

                <div class="field_right image_wrap">
                    <img src="<?php esc_html_e( $gallery_data['image_url'][$i] ); ?>" />
                </div>

                <div class="clear" /></div>
        </div>
    <?php }
    }
    ?>
    </div>
</div>