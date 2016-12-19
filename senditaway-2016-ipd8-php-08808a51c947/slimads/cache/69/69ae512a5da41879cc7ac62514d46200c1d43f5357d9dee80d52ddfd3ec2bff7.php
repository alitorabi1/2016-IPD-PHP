<?php

/* postad_success.html.twig */
class __TwigTemplate_c23e53f62fdbf7a1e4be614662b755d5e30cd786c34a08237785e26f023db1c4 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        echo "<p>The add: [";
        echo twig_escape_filter($this->env, (isset($context["msg"]) ? $context["msg"] : null), "html", null, true);
        echo ", it's ";
        echo twig_escape_filter($this->env, (isset($context["price"]) ? $context["price"] : null), "html", null, true);
        echo "\$ and can be reached at ";
        echo twig_escape_filter($this->env, (isset($context["email"]) ? $context["email"] : null), "html", null, true);
        echo " ]
   was successfully added.
</p>
<a href=\"/\">Click to continue</a>
";
    }

    public function getTemplateName()
    {
        return "postad_success.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  19 => 2,);
    }

    public function getSource()
    {
        return "{# empty Twig template #}
<p>The add: [{{msg}}, it's {{price}}\$ and can be reached at {{email}} ]
   was successfully added.
</p>
<a href=\"/\">Click to continue</a>
";
    }
}
