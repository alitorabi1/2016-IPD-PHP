<?php

/* delete.html.twig */
class __TwigTemplate_f8ade4d16b0ca60cae6daee92e84f041691ceaf7d16cf06b077838c10ded5f68 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("master.html.twig", "delete.html.twig", 1);
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
        echo "User dlete";
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        echo "
<h1>user was deleted successfully</h1>
<a href=\"/login\">Go to home</a>

";
    }

    public function getTemplateName()
    {
        return "delete.html.twig";
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

{% block title %}User dlete{% endblock %}

{% block content %}

<h1>user was deleted successfully</h1>
<a href=\"/login\">Go to home</a>

{% endblock %}
";
    }
}
