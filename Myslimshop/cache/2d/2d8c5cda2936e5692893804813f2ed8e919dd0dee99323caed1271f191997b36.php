<?php

/* register_success.html.twig */
class __TwigTemplate_d7b7f4e9c00281dda3dbed796c0aaa0f0420913c118410be670689ba2ddc3962 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("master.html.twig", "register_success.html.twig", 1);
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
        echo "User login";
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        echo "
<h3>You have been registered successfuly</h3>
<p><a href=\"/\">Go to home</a></p>

";
    }

    public function getTemplateName()
    {
        return "register_success.html.twig";
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

{% block title %}User login{% endblock %}

{% block content %}

<h3>You have been registered successfuly</h3>
<p><a href=\"/\">Go to home</a></p>

{% endblock %}
";
    }
}
