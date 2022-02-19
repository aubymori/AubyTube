<?php
    ob_start();
    $root = $_SERVER["DOCUMENT_ROOT"];
    $views = $root . "/view";
    $templates = $root . "/template";

    include_once($root . "/vendor/autoload.php");

    require("mod/spfPhp.php");

    $twigLoader = new \Twig\Loader\FilesystemLoader($templates);
    $twig = new \Twig\Environment($twigLoader);

    $at = (object) [];

    $at -> guide = (object) [
        "data" => (object) [
            "guideSections" => [
                (object) [
                    "guideSection" => (object) [
                        "items" => [
                            (object) [
                                "guideItem" => (object) [
                                    "icon" => (object) [
                                        "type" => "what-to-watch",
                                    ],
                                    "label" => (object) [
                                        "text" => "What to Watch",
                                    ],
                                    "href" => "/",
                                    "id" => "what_to_watch",
                                    "idBase64" => base64_encode("what_to_watch") . "%3D",
                                ]
                            ],
                            (object) [
                                "guideItem" => (object) [
                                    "label" => (object) [
                                        "text" => "Debug"
                                    ],
                                    "href" => "/debug",
                                    "id" => "debug",
                                    "idBase64" => base64_encode("debug") . "%3D"
                                ]
                            ],
                            (object) [
                                "guideSectionSeparator" => (object) []
                            ]
                        ]
                    ] 
                ]
            ]
        ]
    ];

    $twig -> addGlobal("at", $at);

    function redirect($url) {
        header("Location: " . $url);
    }

    function betterParseUrl($url) {
        $purl = parse_url($url);
        $response = (object) [];
        foreach(explode(' ', 'scheme host port user pass fragment') as $elm) {
            if (isset($purl[$elm])) {
                $response->{$elm} = $purl[$elm];
            }
        }
    
        if (isset($purl['path'])) {
            $temp = explode('/', $purl['path']);
            if ($temp[0] === '') {
                array_splice($temp, 0, 1);
            }
            $response->path = $temp;
        }
    
        if (isset($purl['query'])) {
            $response->query = explode('&', $purl['query']);
        }
    
        return $response;
    }
    
    $routerUrl = betterParseUrl($_SERVER['REQUEST_URI']);

    switch ($routerUrl -> path[0]) {
        case "":
            include($views . "/feed/what_to_watch.php");
            break;
        case "feed":
            if (isset($routerUrl -> path[1])) {
                switch ($routerUrl -> path[1]) {
                    case "what_to_watch":
                        redirect("/");
                        break;
                    default:
                        http_response_code(404);
                        include($views . "/404.php");
                        break;
                }
            } else {
                http_response_code(404);
                include($views . "/404.php");
                break;
            }
            break;
        case "attribution":
            include($views . "/attribution.php");
            break;
        case "debug":
            include($views . "/debug.php");
            break;
        default:
            http_response_code(404);
            include($views . "/404.php");
            break;
    }

    if (isset($_GET['spf'])) {
        $at->spf = true;
        $__spfState = $_GET['spf'];
        $__spfUrl = preg_replace('/.spf='.$_GET['spf'].'/', '', $_SERVER['REQUEST_URI']);
    }

    use \SpfPhp\SpfPhp;
    const SPF_NAV = 'navigate';
    const SPF_NB = 'navigate-back';
    const SPF_NF = 'navigate-forward';
    const SPF_LOAD = 'load';
    if (isset($__spfState) && 
        ($__spfState == SPF_NAV ||
        $__spfState == SPF_NB ||
        $__spfState == SPF_NF)
    ) {
        $at->spfIdListeners = [
            '@body<class>',
            'player-unavailable<class>',
            'debug',
            'early-body',
            'appbar-content<class>',
            'alerts',
            'content',
            '@page<class>',
            'header',
            'ticker-content',
            'player-playlist',
            '@player<class>'
        ];
        $at->spfUrl = $__spfUrl;
    }
    if (isset($at->spf) && $at->spf) { // isset to prevent warning
        $_htmlBuffer = ob_get_clean();
        header('Content-Type: application/json');

        $spfResponse = @SpfPhp::build(
            $_htmlBuffer,
            $at->spfIdListeners,
            (object) [
                'skipSerialisation' => true
            ]
        );
        if (isset($at->spfUrl)) $spfResponse->url = $at->spfUrl;
        if (isset($at->spfName)) $spfResponse->name = $at->spfName;

        if (isset($at->playerResponse)) {
            $spfResponse->data = (object) ['swfcfg' => (object) ['args' => (object) [
                'raw_player_response' => null,
                'raw_watch_next_response' => null
            ]]];
            $spfResponse->data->swfcfg->args->raw_player_response = $at->playerResponse;
            $spfResponse->data->swfcfg->args->raw_watch_next_response = json_decode($at->rawWatchNextResponse);
        }

        echo json_encode($spfResponse);
    } else {
        ob_end_flush();
    }