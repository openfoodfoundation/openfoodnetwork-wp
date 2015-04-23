jQuery(document).ready(function ($)
{
    $(".upload_logo").click(function (event)
    {
		button = $(this);
		
        var myUploadFrame = false;
        event.preventDefault();
        if (myUploadFrame)
        {
            myUploadFrame.open();
            return
        }
        myUploadFrame = wp.media.frames.my_upload_frame = wp.media(
        {
            frame: "select",
            title: "Upload Media",
            library: {
                type: "image"
            },
            button: {
                text: "Send To Options Page",
            },
            multiple: false
        });
        myUploadFrame.on("select", function ()
        {
            var selection = myUploadFrame.state().get("selection");
            selection.map(function (attachment)
            {
                attachment = attachment.toJSON();
                if (attachment.id)
                {
                    var newLogoID = attachment.id;
                    var logoMediumImageSize = attachment.sizes.medium.url;
                    button.prev().val(attachment.sizes.full.url);
                    var newLogoImage = $("<img>").attr(
                    {
                        src: logoMediumImageSize
                    });
                    button.next().empty().append(newLogoImage)
                }
            })
        });
        myUploadFrame.open()
    })
});