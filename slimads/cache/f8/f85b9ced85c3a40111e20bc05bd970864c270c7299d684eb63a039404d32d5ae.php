<?php

/* postad.html.twig */
class __TwigTemplate_098824506adb0dc583a595e779f15ff673438eb382eb077734065d737f55d249 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        echo "
<h1>Post Ad</h1>

";
        // line 5
        if ((isset($context["errorList"]) ? $context["errorList"] : null)) {
            // line 6
            echo "    <ul>
        ";
            // line 7
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["errorList"]) ? $context["errorList"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 8
                echo "            <li>";
                echo twig_escape_filter($this->env, $context["error"], "html", null, true);
                echo "</li>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['error'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 10
            echo "    </ul>
";
        }
        // line 12
        echo "
<form method=\"post\">
    Post Ad: <textarea name=\"msg\">";
        // line 14
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["v"]) ? $context["v"] : null), "msg", array()), "html", null, true);
        echo "</textarea><br><br>
    Price: <input type=\"number\" name=\"price\" value=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["v"]) ? $context["v"] : null), "price", array()), "html", null, true);
        echo "\"><br><br>
    Contact email: <input type=\"text\" name=\"contactEmail\" value=\"";
        // line 16
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["v"]) ? $context["v"] : null), "contactEmail", array()), "html", null, true);
        echo "\"><br><br>
    <input type=\"submit\" value=\"Post Ad\">
</form>";
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
        return array (  58 => 16,  54 => 15,  50 => 14,  46 => 12,  42 => 10,  33 => 8,  29 => 7,  26 => 6,  24 => 5,  19 => 2,);
    }

    public function getSource()
    {
        return "{# empty Twig template #}

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
</form>";
    }
}
