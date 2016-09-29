<?php

/* login.html.twig */
class __TwigTemplate_f7ecf66f5a40c3b78bc3fb6d44c34bfee83177cb08b84c5df3077cc5258601ce extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("master.html.twig", "login.html.twig", 1);
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
<h7>You may <a href=\"/register\">Register</a></h7>

";
        // line 9
        if ((isset($context["errorList"]) ? $context["errorList"] : null)) {
            // line 10
            echo "    <ul>
        ";
            // line 11
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["errorList"]) ? $context["errorList"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 12
                echo "            <li>";
                echo twig_escape_filter($this->env, $context["error"], "html", null, true);
                echo "</li>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['error'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 14
            echo "    </ul>
";
        }
        // line 16
        echo "
<h1>Login</h1>
<form method=\"post\">
    Email: <input type=\"text\" name=\"email\" value=\"";
        // line 19
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["v"]) ? $context["v"] : null), "email", array()), "html", null, true);
        echo "\"><br><br>
    Password: <input type=\"password\" name=\"pass\"><br><br>
    <input type=\"submit\" value=\"Login\">
</form>

";
    }

    public function getTemplateName()
    {
        return "login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  70 => 19,  65 => 16,  61 => 14,  52 => 12,  48 => 11,  45 => 10,  43 => 9,  38 => 6,  35 => 5,  29 => 3,  11 => 1,);
    }

    public function getSource()
    {
        return "{% extends \"master.html.twig\" %}

{% block title %}User login{% endblock %}

{% block content %}

<h7>You may <a href=\"/register\">Register</a></h7>

{% if errorList %}
    <ul>
        {% for error in errorList %}
            <li>{{error}}</li>
        {% endfor %}
    </ul>
{% endif %}

<h1>Login</h1>
<form method=\"post\">
    Email: <input type=\"text\" name=\"email\" value=\"{{v.email}}\"><br><br>
    Password: <input type=\"password\" name=\"pass\"><br><br>
    <input type=\"submit\" value=\"Login\">
</form>

{% endblock %}
";
    }
}
