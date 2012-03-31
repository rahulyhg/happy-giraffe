<li id="album_photo_<?php echo $data->id; ?>">
    <table>
        <tr>
            <td class="img">
                <div>
                    <?php echo CHtml::link(CHtml::image($data->getPreviewUrl(150, 150, Image::WIDTH)), array('/albums/photo', 'id' => $data->id)); ?>
                </div>
            </td>
        </tr>
        <tr class="title">
            <td align="center">
                <div>
                    <?php echo $data->title != '' ? $data->title : '&nbsp;' ?>
                </div>
            </td>
        </tr>
    </table>
</li>