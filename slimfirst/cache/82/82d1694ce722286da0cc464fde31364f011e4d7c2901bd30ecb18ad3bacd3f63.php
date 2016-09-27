<?php

/* sayhello_success.html.twig */
class __TwigTemplate_af3bca712e8eb9cb62c57029eca6ed53e3ffde8fcfe9bb9a30efa3ca0d29c54b extends Twig_Template
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
        echo "
<p>Hello ";
        // line 3
        echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : null), "html", null, true);
        echo ", you are ";
        echo twig_escape_filter($this->env, (isset($context["age"]) ? $context["age"] : null), "html", null, true);
        echo " years old.</p>
";
    }

    public function getTemplateName()
    {
        return "sayhello_success.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  22 => 3,  19 => 2,);
    }

    public function getSource()
    {
        return "{# empty Twig template #}

<p>Hello {{ name }}, you are {{ age }} years old.</p>
";
    }
}
