<?php

/* index.html.twig */
class __TwigTemplate_2d53997c3103f06001bb8b7eeacfd73692767fc068df0986f9135907abedb93b extends Twig_Template
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
        echo "Travels";
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        echo "
    <h1>Welcome to travels</h1>

    ";
        // line 9
        if ((isset($context["sessionUser"]) ? $context["sessionUser"] : null)) {
            // line 10
            echo "        <p>Hello ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["sessionUser"]) ? $context["sessionUser"] : null), "name", array()), "html", null, true);
            echo " (";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["sessionUser"]) ? $context["sessionUser"] : null), "passport", array()), "html", null, true);
            echo ").
            You may <a href=\"/book\">book</a> or <a href=\"/logout\">logout</a>.</p>
            ";
            // line 12
            if ((isset($context["valueList"]) ? $context["valueList"] : null)) {
                echo " 
            <table border=\"1\">
                <tr>
                    <th>ID</th>
                    <th>From airport</th>
                    <th>To airport</th>
                </tr>
                ";
                // line 19
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["valueList"]) ? $context["valueList"] : null));
                foreach ($context['_seq'] as $context["_key"] => $context["v"]) {
                    // line 20
                    echo "                    <tr>
                        <td>";
                    // line 21
                    echo twig_escape_filter($this->env, $this->getAttribute($context["v"], "ID", array()), "html", null, true);
                    echo "</td>
                        <td>";
                    // line 22
                    echo twig_escape_filter($this->env, $this->getAttribute($context["v"], "fromAirport", array()), "html", null, true);
                    echo "</td>
                        <td>";
                    // line 23
                    echo twig_escape_filter($this->env, $this->getAttribute($context["v"], "toAirport", array()), "html", null, true);
                    echo "</td>
                    </tr>
                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['v'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 26
                echo "            </table>
        ";
            } else {
                // line 28
                echo "            <p>There are no booking items to show</p>   
        ";
            }
            // line 30
            echo "    ";
        } else {
            // line 31
            echo "        <p>You may <a href=\"/login\">login</a> or <a href=\"/register\">register</a>.</p>
    ";
        }
        // line 33
        echo "
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
        return array (  102 => 33,  98 => 31,  95 => 30,  91 => 28,  87 => 26,  78 => 23,  74 => 22,  70 => 21,  67 => 20,  63 => 19,  53 => 12,  45 => 10,  43 => 9,  38 => 6,  35 => 5,  29 => 3,  11 => 1,);
    }

    public function getSource()
    {
        return "{% extends \"master.html.twig\" %}

{% block title %}Travels{% endblock %}

{% block content %}

    <h1>Welcome to travels</h1>

    {% if sessionUser %}
        <p>Hello {{sessionUser.name}} ({{sessionUser.passport}}).
            You may <a href=\"/book\">book</a> or <a href=\"/logout\">logout</a>.</p>
            {% if valueList %} 
            <table border=\"1\">
                <tr>
                    <th>ID</th>
                    <th>From airport</th>
                    <th>To airport</th>
                </tr>
                {% for v in valueList %}
                    <tr>
                        <td>{{v.ID}}</td>
                        <td>{{v.fromAirport}}</td>
                        <td>{{v.toAirport}}</td>
                    </tr>
                {% endfor %}
            </table>
        {% else %}
            <p>There are no booking items to show</p>   
        {% endif %}
    {% else %}
        <p>You may <a href=\"/login\">login</a> or <a href=\"/register\">register</a>.</p>
    {% endif %}

{% endblock %}";
    }
}
