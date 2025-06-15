<?php
if (have_rows('content')):
    while (have_rows('content')):
        the_row();
        if (get_row_layout() === 'text-media'):
            include('content/text-media/text-media.php');
        elseif (get_row_layout() === 'image'):
            include('content/image/image.php');
        elseif (get_row_layout() === 'video'):
            include('content/video/video.php');
        elseif (get_row_layout() === 'grid-card'):
            include('content/text-media/grid-card.php');
        elseif (get_row_layout() === 'project-card'):
          include('content/project-card/project-card.php');
        elseif (get_row_layout() === 'gallery'):
            include('content/gallery/gallery.php');
        elseif (get_row_layout() === 'slider'):
            include('content/slider/slider.php');
        elseif (get_row_layout() === 'spiral-timeline'):
            include('content/spiral-timeline/spiral-timeline.php');
        endif;
    endwhile;
endif;
