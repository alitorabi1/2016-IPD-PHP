<?php

/* index.html.twig */
class __TwigTemplate_1186c061694f516e7af4a7485c8b569594e72e19577623afcaa9a52c61375f47 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("master.html.twig", "index.html.twig", 1);
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
        echo "Home";
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        echo "
<h3>Please <a href=\"index.php/register\">Register</a> or <a href=\"index.php/login\">Login</a></h3>

<table border='1'>
";
        // line 10
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["adList"]) ? $context["adList"] : null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["ad"]) {
            // line 11
            echo "    <tr><td> ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["ad"], "msg", array()), "html", null, true);
            echo " </td><td> ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["ad"], "price", array()), "html", null, true);
            echo " </td><td> ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["ad"], "contactEmail", array()), "html", null, true);
            echo " </td><td><a href=\"/postad/";
            echo twig_escape_filter($this->env, $this->getAttribute($context["ad"], "ID", array()), "html", null, true);
            echo "\">Edit Ad</a></td></tr>
";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 13
            echo "    <tr><td colspan='2'>No ads have been found</td><td><a href=\"/postad\">Post Ad</a></td></tr>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ad'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 15
        echo "</table>

";
    }

    public function getTemplateName()
    {
        return "index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  70 => 15,  63 => 13,  49 => 11,  44 => 10,  38 => 6,  35 => 5,  29 => 3,  11 => 1,);
    }

    public function getSource()
    {
        return "{% extends \"master.html.twig\" %}

{% block title %}Home{% endblock %}

{% block content %}

<h3>Please <a href=\"index.php/register\">Register</a> or <a href=\"index.php/login\">Login</a></h3>

<table border='1'>
{% for ad in adList %}
    <tr><td> {{ ad.msg }} </td><td> {{ad.price}} </td><td> {{ad.contactEmail}} </td><td><a href=\"/postad/{{ad.ID}}\">Edit Ad</a></td></tr>
{% else %}
    <tr><td colspan='2'>No ads have been found</td><td><a href=\"/postad\">Post Ad</a></td></tr>
{% endfor %}
</table>

{% endblock %}
";
    }
}
