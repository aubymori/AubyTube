<?php
    $at -> guideItemId = base64_encode("debug") . "%3D";
    echo $twig -> render("debug.twig");