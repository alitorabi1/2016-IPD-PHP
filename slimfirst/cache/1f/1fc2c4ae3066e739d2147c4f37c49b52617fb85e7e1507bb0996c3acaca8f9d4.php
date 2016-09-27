<?php

/* sayhello.html.twig */
class __TwigTemplate_97a1f195f6c516b4587b035f7699512a2530b1ebe225a966a17d436a19ee0295 extends Twig_Template
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
<h1>Say hello</h1>

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
    Name: <input type=\"text\" name=\"name\" value=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["v"]) ? $context["v"] : null), "name", array()), "html", null, true);
        echo "\"><br><br>
    Age: <input type=\"number\" name=\"age\" value=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["v"]) ? $context["v"] : null), "age", array()), "html", null, true);
        echo "\"><br><br>
    <input type=\"submit\" value=\"Say hello\">
</form>";
    }

    public function getTemplateName()
    {
        return "sayhello.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  54 => 15,  50 => 14,  46 => 12,  42 => 10,  33 => 8,  29 => 7,  26 => 6,  24 => 5,  19 => 2,);
    }

    public function getSource()
    {
        return "{# empty Twig template #}

<h1>Say hello</h1>

{% if errorList %}
    <ul>
        {% for error in errorList %}
            <li>{{error}}</li>
        {% endfor %}
    </ul>
{% endif %}

<form method=\"post\">
    Name: <input type=\"text\" name=\"name\" value=\"{{v.name}}\"><br><br>
    Age: <input type=\"number\" name=\"age\" value=\"{{v.age}}\"><br><br>
    <input type=\"submit\" value=\"Say hello\">
</form>";
    }
}
