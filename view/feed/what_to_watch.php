<?php
    $at -> guideItemId = base64_encode("what_to_watch") . "%3D";

    $at -> page = (object) [];
    $at -> page -> data = (object) [
        "shelves" => [
            (object) [
                "largeFeaturedShelf" => (object) [
                    "title" => "Featured",
                    "items" => [
                        (object) [
                            "videoLockup" => (object) [
                                "videoId" => "dQw4w9WgXcQ",
                                "thumbnail" => "/ats/imgbin/www-thumb-default.png",
                                "title" => "Rick Astley - Never Gonna Give You Up (Official Video)",
                                "author" => (object) [
                                    "username" => "RickAstleyVEVO",
                                    "verified" => true
                                ],
                                "views" => (object) [
                                    "count" => 22699413,
                                    "countCommas" => "22,699,413"
                                ],
                                "uploadTime" => (object) [
                                    "label" => "1 day ago",
                                    "date" => "2022-02-18"
                                ]
                            ]
                        ],
                        (object) [
                            "videoLockup" => (object) [
                                "videoId" => "dQw4w9WgXcQ",
                                "thumbnail" => "/ats/imgbin/www-thumb-default.png",
                                "title" => "Rick Astley - Never Gonna Give You Up (Official Video)",
                                "author" => (object) [
                                    "username" => "RickAstleyVEVO",
                                    "verified" => true
                                ],
                                "views" => (object) [
                                    "count" => 22699413,
                                    "countCommas" => "22,699,413"
                                ],
                                "uploadTime" => (object) [
                                    "label" => "1 day ago",
                                    "date" => "2022-02-18"
                                ]
                            ]
                        ],
                        (object) [
                            "videoLockup" => (object) [
                                "videoId" => "dQw4w9WgXcQ",
                                "thumbnail" => "/ats/imgbin/www-thumb-default.png",
                                "title" => "Rick Astley - Never Gonna Give You Up (Official Video)",
                                "author" => (object) [
                                    "username" => "RickAstleyVEVO",
                                    "verified" => true
                                ],
                                "views" => (object) [
                                    "count" => 22699413,
                                    "countCommas" => "22,699,413"
                                ],
                                "uploadTime" => (object) [
                                    "label" => "1 day ago",
                                    "date" => "2022-02-18"
                                ]
                            ]
                        ],
                        (object) [
                            "videoLockup" => (object) [
                                "videoId" => "dQw4w9WgXcQ",
                                "thumbnail" => "/ats/imgbin/www-thumb-default.png",
                                "title" => "Rick Astley - Never Gonna Give You Up (Official Video)",
                                "author" => (object) [
                                    "username" => "RickAstleyVEVO",
                                    "verified" => true
                                ],
                                "views" => (object) [
                                    "count" => 22699413,
                                    "countCommas" => "22,699,413"
                                ],
                                "uploadTime" => (object) [
                                    "label" => "1 day ago",
                                    "date" => "2022-02-18"
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ];

    echo $twig -> render("feed/what_to_watch.twig");
