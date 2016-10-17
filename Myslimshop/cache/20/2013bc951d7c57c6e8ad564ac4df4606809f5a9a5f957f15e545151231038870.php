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
            'head' => array($this, 'block_head'),
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
        echo "User registeration";
    }

    // line 5
    public function block_head($context, array $blocks = array())
    {
        // line 6
        echo "  
    <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js\"></script>
    <script>
        \$(document).ready(function() {
            \$('input[name=email]').keyup(function() {
                \$('#result').load('/emailexists/' + \$(this).val());
            });
        });
    </script>

";
    }

    // line 18
    public function block_content($context, array $blocks = array())
    {
        // line 19
        echo "
<h7>You may go to <a href=\"/\">home page</a> or <a href=\"/login\">login</a></h7>

";
        // line 22
        if ((isset($context["errorList"]) ? $context["errorList"] : null)) {
            // line 23
            echo "    <ul>
        ";
            // line 24
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["errorList"]) ? $context["errorList"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 25
                echo "            <li>";
                echo twig_escape_filter($this->env, $context["error"], "html", null, true);
                echo "</li>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['error'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 27
            echo "    </ul>
";
        }
        // line 29
        echo "
<h1>Register user</h1>
<form method=\"post\">
    Name: <input type=\"text\" name=\"name\" value=\"";
        // line 32
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["v"]) ? $context["v"] : null), "name", array()), "html", null, true);
        echo "\"><br><br>
    Email: <input type=\"text\" name=\"email\" value=\"";
        // line 33
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["v"]) ? $context["v"] : null), "email", array()), "html", null, true);
        echo "\">
    <span id=\"result\"></span><br><br>
    Password: <input type=\"password\" name=\"pass1\"><br><br>
    Password (repeated) <input type=\"password\" name=\"pass2\"><br><br>
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
        return array (  92 => 33,  88 => 32,  83 => 29,  79 => 27,  70 => 25,  66 => 24,  63 => 23,  61 => 22,  56 => 19,  53 => 18,  39 => 6,  36 => 5,  30 => 3,  11 => 1,);
    }

    public function getSource()
    {
        return "{% extends \"master.html.twig\" %}

{% block title %}User registeration{% endblock %}

{% block head %}
  
    <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js\"></script>
    <script>
        \$(document).ready(function() {
            \$('input[name=email]').keyup(function() {
                \$('#result').load('/emailexists/' + \$(this).val());
            });
        });
    </script>

{% endblock %}

{% block content %}

<h7>You may go to <a href=\"/\">home page</a> or <a href=\"/login\">login</a></h7>

{% if errorList %}
    <ul>
        {% for error in errorList %}
            <li>{{error}}</li>
        {% endfor %}
    </ul>
{% endif %}

<h1>Register user</h1>
<form method=\"post\">
    Name: <input type=\"text\" name=\"name\" value=\"{{v.name}}\"><br><br>
    Email: <input type=\"text\" name=\"email\" value=\"{{v.email}}\">
    <span id=\"result\"></span><br><br>
    Password: <input type=\"password\" name=\"pass1\"><br><br>
    Password (repeated) <input type=\"password\" name=\"pass2\"><br><br>
    <input type=\"submit\" value=\"Register\">
</form>

{% endblock %}
";
    }
}
