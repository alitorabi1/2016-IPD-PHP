<?php

/* logout.html.twig */
class __TwigTemplate_2b2a10208d7d32c149d3e52ec1a9e03d1bdf1266d325884cb8c53b922d9444a7 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("master.html.twig", "logout.html.twig", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "master.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        echo "User logout";
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        echo "
<h7>You have been logged out. You may <a href=\"/login\">Login</a>again or <a href=\"/\">Go to home page</a></h7>

";
    }

    public function getTemplateName()
    {
        return "logout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  38 => 6,  35 => 5,  29 => 3,  11 => 1,);
    }

    public function getSource()
    {
        return "{% extends \"master.html.twig\" %}

{% block title %}User logout{% endblock %}

{% block content %}

<h7>You have been logged out. You may <a href=\"/login\">Login</a>again or <a href=\"/\">Go to home page</a></h7>

{% endblock %}
";
    }
}
