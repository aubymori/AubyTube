<?php
    $at -> guideItemId = base64_encode("what_to_watch") . "%3D";
    echo $twig -> render("feed/what_to_watch.twig");