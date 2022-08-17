<?php
namespace AubyTube\Controller\core;

use SpfPhp\SpfPhp;

/**
 * Defines a general YouTube Nirvana controller.
 * 
 * This implements the base API and data used to render a Nirvana (Appbar)
 * page.
 * 
 * @author Taniko Yamamoto <kirasicecreamm@gmail.com>
 * @author Aubrey Pankow <aubyomori@gmail.com>
 * @author Daylin Cooper <dcoop2004@gmail.com>
 */
abstract class NirvanaController extends HitchhikerController
{
    /**
     * Don't request the guide on initial visit.
     * 
     * This should be true on pages like watch, where the guide
     * isn't open by default.
     * 
     * @var bool
     */
    protected $delayLoadGuide = false;

    /** @inheritdoc */
    protected $spfIdListeners = [
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
        'player-playlist<class>',
        '@player<class>'
    ];

    /** @inheritdoc */
    protected function init(&$at, &$template)
    {
        $at->spfEnabled = true;
        $at->useModularCore = true;
        $at->modularCoreModules = [];
        $at->page = (object)[];
    }

    /**
     * Define the page to use a JS page module.
     * 
     * @param string $module  Name of the module (not URL)
     * 
     * @return void
     */
    protected function useJsModule($module)
    {
        $this->at->modularCoreModules[] = $module;
    }
}