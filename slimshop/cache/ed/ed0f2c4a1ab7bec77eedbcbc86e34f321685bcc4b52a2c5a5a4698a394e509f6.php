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
<h7>You may <a href=\"/register\">Register</a> or <a href=\"/login\">Login</a> or <a href=\"/logout\">Log out</a></h7>

<br><br>
";
        // line 10
        if ((isset($context["userList"]) ? $context["userList"] : null)) {
            // line 11
            echo "    <table border=\"1\">
        <tr>
            <th>Name</th>
            <th>email</th>
            <th>Operations</th>
        </tr>
            ";
            // line 17
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["userList"]) ? $context["userList"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["u"]) {
                // line 18
                echo "            <tr>
                <td>";
                // line 19
                echo twig_escape_filter($this->env, $this->getAttribute($context["u"], "name", array()), "html", null, true);
                echo "</td>
                <td>";
                // line 20
                echo twig_escape_filter($this->env, $this->getAttribute($context["u"], "email", array()), "html", null, true);
                echo "</td>
                <td><a href='/delete/";
                // line 21
                echo twig_escape_filter($this->env, $this->getAttribute($context["u"], "ID", array()), "html", null, true);
                echo "'>Delete user</a></td>
            </tr>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['u'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 24
            echo "    </table>
    ";
        } else {
            // line 26
            echo "        <p>There are no user yet</p>   
";
        }
        // line 28
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
        return array (  86 => 28,  82 => 26,  78 => 24,  69 => 21,  65 => 20,  61 => 19,  58 => 18,  54 => 17,  46 => 11,  44 => 10,  38 => 6,  35 => 5,  29 => 3,  11 => 1,);
    }

    public function getSource()
    {
        return "{% extends \"master.html.twig\" %}

{% block title %}Home{% endblock %}

{% block content %}

<h7>You may <a href=\"/register\">Register</a> or <a href=\"/login\">Login</a> or <a href=\"/logout\">Log out</a></h7>

<br><br>
{% if userList %}
    <table border=\"1\">
        <tr>
            <th>Name</th>
            <th>email</th>
            <th>Operations</th>
        </tr>
            {% for u in userList %}
            <tr>
                <td>{{u.name}}</td>
                <td>{{u.email}}</td>
                <td><a href='/delete/{{u.ID}}'>Delete user</a></td>
            </tr>
            {% endfor %}
    </table>
    {% else %}
        <p>There are no user yet</p>   
{% endif %}

{% endblock %}
";
    }
}
