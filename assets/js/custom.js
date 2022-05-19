/** Galleries closure Function for backend side */

const Galleries = (function ($) {
    let frame;

    const addImage = (obj) => {
        const _this = obj;

        // If the media frame already exists, reopen it.
        if (frame) {
            frame.open();
            return;
        }

        // Create a new media frame
        frame = wp.media({
            title: 'Select or Upload Image',
            button: {
                text: 'Use this Image',
            },
            multiple: false,
        });

        frame.on( 'select', () => {
            const state = frame.state();
            const selection = state.get('selection');

            if ( ! selection ) {
                return;
            }

            selection.each( (attachment) => {
                const wrap = jQuery(_this).closest('.field_row');
                wrap.find('.meta_image_url').val(attachment.attributes.url);
                wrap.find('.image_wrap').html('<img src="'+attachment.attributes.url+'">');
                console.log('img', attachment.attributes.url);
            });
        });

        // Finally, open the modal on click
        frame.open();
    };

    const removeField = (obj) => {
        const parent = $(obj).parent().parent();
        parent.remove();
    };

    const addFieldRow = () =>{
        $('#field_wrap').append(addImageRow);
    };

    const addImageRow = () =>{
        return `<div class="field_row">
                    <div class="field_left">
                        <div class="form_field">
                            <label>Image URL</label>
                            <input class="meta_image_url" value="" type="text" name="gallery[image_url][]" />
                        </div>
                    </div>
                    <div class="field_right">
                        <input type="button" class="button" value="Choose Image" onclick="Galleries.addImage(this)" />
                        <br />
                        <input class="button" type="button" value="Remove Image" onclick="Galleries.removeField(this)" />
                    </div>
                    <div class="field_right image_wrap"> </div>
                    <div class="clear"></div>
                </div>`;
    };

    return {
        addImage,
        removeField,
        addFieldRow
    };

})(jQuery);
