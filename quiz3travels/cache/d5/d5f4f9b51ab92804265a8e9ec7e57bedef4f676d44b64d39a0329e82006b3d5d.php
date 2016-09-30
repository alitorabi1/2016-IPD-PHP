<?php

/* book.html.twig */
class __TwigTemplate_37b4c0937d69d96d9e03ebd20b39d2ed6d38d9cfb939c48014ee1010d72c1e6c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("master.html.twig", "book.html.twig", 1);
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
        echo "Booking";
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        echo "            
<h1>Booking</h1>

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
                echo "        <li>";
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
";
        // line 17
        if ((isset($context["sessionUser"]) ? $context["sessionUser"] : null)) {
            // line 18
            echo "    <p>Hi ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["sessionUser"]) ? $context["sessionUser"] : null), "name", array()), "html", null, true);
            echo " (";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["sessionUser"]) ? $context["sessionUser"] : null), "passport", array()), "html", null, true);
            echo ").
        You want to travel</p>
";
        } else {
            // line 21
            echo "    <p>You may <a href=\"/login\">login</a> or <a href=\"/register\">register</a>.</p>
";
        }
        // line 23
        echo "
<form method=\"post\">
    From: <input type=\"text\" name=\"fromAirport\" value=\"";
        // line 25
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["v"]) ? $context["v"] : null), "fromAirport", array()), "html", null, true);
        echo "\"><br>
    To: <input type=\"text\" name=\"toAirport\" value=\"";
        // line 26
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["v"]) ? $context["v"] : null), "toAirport", array()), "html", null, true);
        echo "\"><br>
    <input type=\"submit\" value=\"Book\">
</form>

";
    }

    public function getTemplateName()
    {
        return "book.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  91 => 26,  87 => 25,  83 => 23,  79 => 21,  70 => 18,  68 => 17,  65 => 16,  61 => 14,  52 => 12,  48 => 11,  45 => 10,  43 => 9,  38 => 6,  35 => 5,  29 => 3,  11 => 1,);
    }

    public function getSource()
    {
        return "{% extends \"master.html.twig\" %}

{% block title %}Booking{% endblock %}

{% block content %}
            
<h1>Booking</h1>

{% if errorList %}
    <ul>
    {% for error in errorList %}
        <li>{{ error }}</li>
    {% endfor %}
    </ul>
{% endif %}

{% if sessionUser %}
    <p>Hi {{sessionUser.name}} ({{sessionUser.passport}}).
        You want to travel</p>
{% else %}
    <p>You may <a href=\"/login\">login</a> or <a href=\"/register\">register</a>.</p>
{% endif %}

<form method=\"post\">
    From: <input type=\"text\" name=\"fromAirport\" value=\"{{v.fromAirport}}\"><br>
    To: <input type=\"text\" name=\"toAirport\" value=\"{{v.toAirport}}\"><br>
    <input type=\"submit\" value=\"Book\">
</form>

{% endblock %}
    ";
    }
}
