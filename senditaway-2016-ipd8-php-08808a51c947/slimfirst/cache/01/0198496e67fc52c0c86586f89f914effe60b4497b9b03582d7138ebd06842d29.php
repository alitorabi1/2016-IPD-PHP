<?php

/* hello.html.twig */
class __TwigTemplate_db38b85f0ba6a3320a3f4b8ba3bebfbf9a0e9dac28837a9ea4196176933ae63a extends Twig_Template
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
<p>Hello (from Twig) ";
        // line 3
        echo twig_escape_filter($this->env, (isset($context["personName"]) ? $context["personName"] : null), "html", null, true);
        echo ", you are ";
        echo twig_escape_filter($this->env, (isset($context["personAge"]) ? $context["personAge"] : null), "html", null, true);
        echo " years old.</p>
";
    }

    public function getTemplateName()
    {
        return "hello.html.twig";
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

<p>Hello (from Twig) {{ personName }}, you are {{ personAge }} years old.</p>
";
    }
}
