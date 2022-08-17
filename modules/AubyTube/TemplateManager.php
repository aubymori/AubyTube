<?php
namespace AubyTube;

use Twig\TwigFunction, Twig\TwigFilter;
use AubyTube\ControllerV2\Core as ControllerV2;

/**
 * Implements the template manager.
 * 
 * This manages Twig and provides an API for interacting with its
 * bound instance.
 * 
 * It generally exists just to get Twig outside of the global
 * scope.
 * 
 * @author Taniko Yamamoto <kirasicecreamm@gmail.com>
 * @author The Rehike Maintainers
 */
class TemplateManager
{
    // Must be an reference to the global Twig instance.
    /** @var \Twig\Environment */
    public static $twig;

    /** @var string */
    public static $template = "";

    // Must be a reference to the global context variable.
    public static $at;

    public static $viewsDir = "templates";

    public static function __initStatic()
    {
        self::$twig = new \Twig\Environment(
            new \Twig\Loader\FilesystemLoader(self::$viewsDir)
        );

        ControllerV2::registerTemplateVariable(self::$template);
    }

    /**
     * Register the global state variable ($at)
     * 
     * @param object $at (reference)
     * @return void
     */
    public static function registerGlobalState(&$at)
    {
        self::$at = &$at;
        self::addGlobal("at", $at);
    }

    /**
     * Render the template.
     * 
     * @param array $vars to additionally pass
     */
    public static function render($vars = [], $template = "")
    {
        if (!is_array($vars) && !is_null($vars)) throw new \Exception("\$vars must be an array.");

        $passedVars = [self::$at] + $vars;

        if ("" == $template) $template = self::$template;

        return self::$twig->render("$template.twig", $passedVars);
    }

    /**
     * Add a global variable to the templater.
     * 
     * @param string $name
     * @param mixed $value
     */
    public static function addGlobal($name, &$value)
    {
        return self::$twig->addGlobal($name, $value);
    }

    /**
     * Add a function to the templater.
     * 
     * @param string|TwigFunction $name
     * @param callback|null $callback
     */
    public static function addFunction($name, $callback = null)
    {
        // $name here is a TwigFunction instance, this ordinarily
        // allows creating TwigFunctions on the fly instead.
        if ($name instanceof TwigFunction)
        {
            return self::$twig->addFunction($name);
        }

        return self::$twig->addFunction(
            new TwigFunction($name, $callback)
        );
    }

    /**
     * Add a filter to the templater.
     * 
     * @param string|TwigFilter $name
     * @param callback|null $callback
     */
    public static function addFilter($name, $callback = null)
    {
        // $name here is a TwigFilter instance, ditto above
        if ($name instanceof TwigFilter)
        {
            return self::$twig->addFilter($name);
        }

        return self::$twig->addFilter(
            new TwigFilter($name, $callback)
        );
    }
}