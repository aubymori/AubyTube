<?php
namespace AubyTube\Controller\core;

use AubyTube\TemplateManager;
use SpfPhp\SpfPhp;
use AubyTube\ControllerV2\RequestMetadata;

/**
 * Defines a general YouTube Hitchhiker controller.
 * 
 * This implements the base API and data used to render a Hitchhiker
 * page.
 * 
 * @author Taniko Yamamoto <kirasicecreamm@gmail.com>
 * @author Aubrey Pankow <aubyomori@gmail.com>
 * @author Daylin Cooper <dcoop2004@gmail.com>
 */
abstract class HitchhikerController
{

    /**
     * Stores all information that is sent to Twig for rendering the page.
     * 
     * @var object $at
     *   + useModularCore (bool, required) - Toggles base.js/core.js use by Hitchhiker.
     *   + modularCoreModules (string[]) - Defines base.js page modules.
     *   + spfEnabled (bool, required) - Enables YouTube SPF (soft loading).
     *   + spf (bool, required) - True if the page is navigated to via SPF.
     *   + title (string) - Page title name
     *   + appbar (object) - Available in NirvanaController; defines YouTube Appbar.
     *   + page (object) - Page metadata
     */
    protected $at;

    /**
     * Defines the default page template.
     * 
     * This may be overridden for certain contexts in an onGet()
     * callback.
     * 
     * @var string
     */
    public $template = "";

    /**
     * Whether or not we should use a Twig template to render.
     * 
     * Some AJAX responses are so simple, that using a template
     * makes no sense.
     * 
     * @var boolean
     */
    public $useTemplate = true;

    /**
     * Defines the default element IDs that are listened to by
     * YouTube's SPF library.
     * 
     * This defines what elements get changed with every soft navigation.
     * 
     * @var string[]
     */
    protected $spfIdListeners = [
        'player-unavailable<class>',
        'alerts',
        'content',
        '@page<class>',
        'player-playlist<class>',
        '@player<class>'
    ];

    /**
     * What the Content-Type header should be in the response
     * 
     * @var string
     */
    public $contentType = "text/html";

    /**
     * Implements the base functionality that is ran on every GET request.
     * 
     * This function should not be overridden for page-specific
     * functionality. Use the controller's API (onGet()) for that.
     * 
     * @param object $at                 Template data.
     * 
     * @param string $template           Passes a template in and out of the function.
     *                                   For API usage, you can safely ignore this. It only
     *                                   matters on the technical end.
     * 
     * @param RequestMetadata $request   Reports request metadata.
     * 
     * @return void
     */
    public function get(&$at, &$template, $request)
    {
        header("Content-Type: " .  $this -> contentType);
        $this->at = &$at;
        $this->init($at, $template);

        $this->onGet($at, $request);

        $this->postInit($at, $template);

        if ($this->useTemplate) $this->doGeneralRender();
    }

    /**
     * Implements the base functionality that is ran on every POST request.
     * 
     * This function should not be overridden for page-specific
     * functionality. Use the controller's API (onPost()) for that.
     * 
     * @param object $at                 Template data.
     * 
     * @param string $template           Passes a template in and out of the function.
     *                                   For API usage, you can safely ignore this. It only
     *                                   matters on the technical end.
     * 
     * @param RequestMetadata $request   Reports request metadata.
     * 
     * @return void
     */
    public function post(&$at, &$template, $request)
    {
        header("Content-Type: " .  $this -> contentType);
        $this->at = &$at;
        $this->init($at, $template);

        $this->onPost($at, $request);

        $this->postInit($at, $template);

        if ($this->useTemplate) $this->doGeneralRender();
    }

    /**
     * Defines the API for handling GET requests. Pages should always use this;
     * only subcontrollers may override onGet() directly.
     * 
     * @param object $at                Template data.
     * @param RequestMetadata $request  Reports request metadata.
     * 
     * @return void
     */
    public function onGet(&$at, $request) {}

    /**
     * Defines the API for handling POST requests. Pages should always use this;
     * only subcontrollers may override onPost() directly.
     * 
     * @param object $at                Template data.
     * @param RequestMetadata $request  Reports request metadata.
     * 
     * @return void
     */
    public function onPost(&$at, $request) {}

    /**
     * Set initial variables for this controller type.
     * 
     * @param $at        Template data.
     * @param $template  Backend template data.
     * 
     * @return void
     */
    protected function init(&$at, &$template)
    {
        $at->spfEnabled = false;
        $at->useModularCore = false;
        $at->page = (object)[];
    }

    /**
     * Defines the tasks performed after the page is done being built.
     * 
     * Mainly, this prepares data internally to prepare sending to Twig.
     * 
     * @param $at        Template data.
     * @param $template  Backend template data.
     * 
     * @return void
     */
    public function postInit(&$at, &$template)
    {
        $template = $this->template;
        
    }

    /**
     * Perform a Twig render, accounting for SPF status if it is enabled, and
     * reporting the debugger if it is enabled.
     * 
     * @return void
     */
    public function doGeneralRender()
    {
        if (SpfPhp::isSpfRequested() && $this->at->spfEnabled)
        {
            // Report SPF status to the templater
            $this->at->spf = true;

            // Capture the render so that we may send it through SpfPhp.
            $capturedRender = TemplateManager::render();

            // Skip serialisation so that the output may be modified. (also 
            // suppress warnings; idk why (buggy library lol))
            $spf = @SpfPhp::parse($capturedRender, $this->spfIdListeners, [
                "skipSerialization" => true
            ]);

            // Post-data generation callback for custom handling
            $this->handleSpfData($spf);

            header("Content-Type: application/json");

            echo json_encode($spf);
        }
        else
        {
            $capturedRender = TemplateManager::render();

            // In the case this is not an SPF request, we don't have to do anything.
            echo $capturedRender;
        }
    }

    /**
     * Modify generated SPF data before it's sent to the client.
     * 
     * For example, adding custom metadata to the response.
     * 
     * @param object $data reference
     * @return void
     */
    public function handleSpfData(&$data) {}
}
