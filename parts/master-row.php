<div style="display:none" id="master-row">
    <div class="field_row">
        <div class="field_left">
            <div class="form_field">
                <label>Image URL</label>
                <input class="meta_image_url" value="" type="text" name="gallery[image_url][]" />
            </div>
        </div>
        <div class="field_right image_wrap"> </div>
        <div class="field_right">
            <input type="button" class="button" value="Choose Image" onclick="Galleries.addImage(this)" />
            <br />
            <input class="button" type="button" value="Remove Image" onclick="Galleries.removeField(this)" />
        </div>
        <div class="clear"></div>
    </div>
</div>