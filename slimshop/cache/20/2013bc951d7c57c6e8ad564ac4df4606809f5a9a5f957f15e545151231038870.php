<?php

/* register.html.twig */
class __TwigTemplate_6dcbfbef8680eb5749561f2918a57e1454486c76e390c1099c3f8ad5c10dc67f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("master.html.twig", "register.html.twig", 1);
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
        echo "All Ads";
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        echo "
<h1>Register user</h1>
<form method=\"post\">
    Name: <input type=\"text\" name=\"name\" value=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["v"]) ? $context["v"] : null), "name", array()), "html", null, true);
        echo "\"><br>
    Email: <input type=\"text\" name=\"email\" value=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["v"]) ? $context["v"] : null), "email", array()), "html", null, true);
        echo "\"><br>
    Password: <input type=\"password\" name=\"pass1\"><br>
    Password (repeated) <input type=\"password\" name=\"pass2\"><br>
    <input type=\"submit\" value=\"Register\">
</form>

";
    }

    public function getTemplateName()
    {
        return "register.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  47 => 10,  43 => 9,  38 => 6,  35 => 5,  29 => 3,  11 => 1,);
    }

    public function getSource()
    {
        return "{% extends \"master.html.twig\" %}

{% block title %}All Ads{% endblock %}

{% block content %}

<h1>Register user</h1>
<form method=\"post\">
    Name: <input type=\"text\" name=\"name\" value=\"{{v.name}}\"><br>
    Email: <input type=\"text\" name=\"email\" value=\"{{v.email}}\"><br>
    Password: <input type=\"password\" name=\"pass1\"><br>
    Password (repeated) <input type=\"password\" name=\"pass2\"><br>
    <input type=\"submit\" value=\"Register\">
</form>

{% endblock %}
";
    }
}
