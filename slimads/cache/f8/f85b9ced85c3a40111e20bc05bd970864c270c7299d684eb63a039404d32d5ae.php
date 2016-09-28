<?php

/* postad.html.twig */
class __TwigTemplate_098824506adb0dc583a595e779f15ff673438eb382eb077734065d737f55d249 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("master.html.twig", "postad.html.twig", 1);
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
        echo "Post Ads";
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        echo "

<h1>Post Ad</h1>

";
        // line 10
        if ((isset($context["errorList"]) ? $context["errorList"] : null)) {
            // line 11
            echo "    <ul>
        ";
            // line 12
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["errorList"]) ? $context["errorList"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 13
                echo "            <li>";
                echo twig_escape_filter($this->env, $context["error"], "html", null, true);
                echo "</li>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['error'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 15
            echo "    </ul>
";
        }
        // line 17
        echo "
<form method=\"post\">
    Post Ad: <textarea name=\"msg\">";
        // line 19
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["v"]) ? $context["v"] : null), "msg", array()), "html", null, true);
        echo "</textarea><br><br>
    Price: <input type=\"number\" name=\"price\" value=\"";
        // line 20
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["v"]) ? $context["v"] : null), "price", array()), "html", null, true);
        echo "\"><br><br>
    Contact email: <input type=\"text\" name=\"contactEmail\" value=\"";
        // line 21
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["v"]) ? $context["v"] : null), "contactEmail", array()), "html", null, true);
        echo "\"><br><br>
    <input type=\"submit\" value=\"Post Ad\">
</form>
    
";
    }

    public function getTemplateName()
    {
        return "postad.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  78 => 21,  74 => 20,  70 => 19,  66 => 17,  62 => 15,  53 => 13,  49 => 12,  46 => 11,  44 => 10,  38 => 6,  35 => 5,  29 => 3,  11 => 1,);
    }

    public function getSource()
    {
        return "{% extends \"master.html.twig\" %}

{% block title %}Post Ads{% endblock %}

{% block content %}


<h1>Post Ad</h1>

{% if errorList %}
    <ul>
        {% for error in errorList %}
            <li>{{error}}</li>
        {% endfor %}
    </ul>
{% endif %}

<form method=\"post\">
    Post Ad: <textarea name=\"msg\">{{v.msg}}</textarea><br><br>
    Price: <input type=\"number\" name=\"price\" value=\"{{v.price}}\"><br><br>
    Contact email: <input type=\"text\" name=\"contactEmail\" value=\"{{v.contactEmail}}\"><br><br>
    <input type=\"submit\" value=\"Post Ad\">
</form>
    
{% endblock %}
";
    }
}
