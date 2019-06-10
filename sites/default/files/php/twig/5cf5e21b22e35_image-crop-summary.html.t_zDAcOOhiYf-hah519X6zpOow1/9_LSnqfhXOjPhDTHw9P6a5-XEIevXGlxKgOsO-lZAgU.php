<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* core/themes/stable/templates/admin/image-crop-summary.html.twig */
class __TwigTemplate_06724aef87da2b68be919a0546a7e9f9d55e7da15ebd9f1dbe87ff36d2c2393b extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["if" => 18, "trans" => 22];
        $filters = ["escape" => 19];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['if', 'trans'],
                ['escape'],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->getSourceContext());

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 18
        if (($this->getAttribute(($context["data"] ?? null), "width", []) && $this->getAttribute(($context["data"] ?? null), "height", []))) {
            // line 19
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["data"] ?? null), "width", [])), "html", null, true);
            echo "×";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["data"] ?? null), "height", [])), "html", null, true);
        } else {
            // line 21
            if ($this->getAttribute(($context["data"] ?? null), "width", [])) {
                // line 22
                echo "    ";
                echo t("width @data.width", array("@data.width" => $this->getAttribute(                // line 23
($context["data"] ?? null), "width", []), ));
                // line 25
                echo "  ";
            } elseif ($this->getAttribute(($context["data"] ?? null), "height", [])) {
                // line 26
                echo "    ";
                echo t("height @data.height", array("@data.height" => $this->getAttribute(                // line 27
($context["data"] ?? null), "height", []), ));
                // line 29
                echo "  ";
            }
        }
    }

    public function getTemplateName()
    {
        return "core/themes/stable/templates/admin/image-crop-summary.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  75 => 29,  73 => 27,  71 => 26,  68 => 25,  66 => 23,  64 => 22,  62 => 21,  57 => 19,  55 => 18,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "core/themes/stable/templates/admin/image-crop-summary.html.twig", "C:\\xampp\\htdocs\\ing_web_2019_cd\\Observatorio_gestion_ambiental\\iamu\\core\\themes\\stable\\templates\\admin\\image-crop-summary.html.twig");
    }
}
