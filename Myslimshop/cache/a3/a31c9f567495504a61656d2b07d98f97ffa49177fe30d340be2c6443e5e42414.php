<?php

/* cart.html.twig */
class __TwigTemplate_4c7e2ac78e570059a522cd91b2fea5965b90127e35c47f4c9878101ab3351c3a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("master.html.twig", "cart.html.twig", 1);
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
        echo "Cart";
    }

    // line 5
    public function block_head($context, array $blocks = array())
    {
        // line 6
        echo "    <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js\"></script>
    <script>
        function increment(ID) {
            var value = \$(\"input[name=quantity\"+ID+\"]\").val();
            value++;
            \$(\"input[name=quantity]\"+ID+\"]\").val(value);
            \$(\"update\" + ID).show();
        }
        function decrement(ID) {
            var value = \$(\"input[name=quantity\"+ID+\"]\").val();
            if (value >0) {
                value--;
            }
            \$(\"input[name=quantity]\"+ID+\"]\").val(value);
            \$(\"update\" + ID).show();
        }
        function update(e,ID) {
            e.preventDefault();
            \$get(\"/cart/update/\" + ID + \"/\" + quantity, function(){
                console.log(\"Quantity updated\");
                \$(\"update\" + ID).show();
            });
        }
        
        
        \$(\"document\").ready(function(){
           \$(\".updateLink\").hide();
        });
    </script>
";
    }

    // line 37
    public function block_content($context, array $blocks = array())
    {
        // line 38
        echo "    <table border=\"1\">
        ";
        // line 39
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["cartitemList"]) ? $context["cartitemList"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["ci"]) {
            // line 40
            echo "            <tr>
                <td>";
            // line 41
            echo twig_escape_filter($this->env, $this->getAttribute($context["ci"], "name", array()), "html", null, true);
            echo "</td>
                <td>";
            // line 42
            echo twig_escape_filter($this->env, $this->getAttribute($context["ci"], "price", array()), "html", null, true);
            echo "</td>
                <td><button onclick=\"decrement(";
            // line 43
            echo twig_escape_filter($this->env, $this->getAttribute($context["ci"], "ID", array()), "html", null, true);
            echo ")\">-</button>
                        <input type=\"number\" name=\"quantity";
            // line 44
            echo twig_escape_filter($this->env, $this->getAttribute($context["ci"], "ID", array()), "html", null, true);
            echo "\"
                               value=\"";
            // line 45
            echo twig_escape_filter($this->env, $this->getAttribute($context["ci"], "quantity", array()), "html", null, true);
            echo "\" style=\"width:30px;\">
                        <button onclick=\"increment(";
            // line 46
            echo twig_escape_filter($this->env, $this->getAttribute($context["ci"], "ID", array()), "html", null, true);
            echo ")\">+</button>
                        <a href=\"\" class=\"updateLink\" id=\"update";
            // line 47
            echo twig_escape_filter($this->env, $this->getAttribute($context["ci"], "ID", array()), "html", null, true);
            echo "\"
                              onclick=\"update(event,";
            // line 48
            echo twig_escape_filter($this->env, $this->getAttribute($context["ci"], "ID", array()), "html", null, true);
            echo ")\">update</a>
                </td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ci'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 52
        echo "    </table>

    ";
    }

    public function getTemplateName()
    {
        return "cart.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  123 => 52,  113 => 48,  109 => 47,  105 => 46,  101 => 45,  97 => 44,  93 => 43,  89 => 42,  85 => 41,  82 => 40,  78 => 39,  75 => 38,  72 => 37,  39 => 6,  36 => 5,  30 => 3,  11 => 1,);
    }

    public function getSource()
    {
        return "{% extends \"master.html.twig\" %}

{% block title %}Cart{% endblock %}

{% block head %}
    <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js\"></script>
    <script>
        function increment(ID) {
            var value = \$(\"input[name=quantity\"+ID+\"]\").val();
            value++;
            \$(\"input[name=quantity]\"+ID+\"]\").val(value);
            \$(\"update\" + ID).show();
        }
        function decrement(ID) {
            var value = \$(\"input[name=quantity\"+ID+\"]\").val();
            if (value >0) {
                value--;
            }
            \$(\"input[name=quantity]\"+ID+\"]\").val(value);
            \$(\"update\" + ID).show();
        }
        function update(e,ID) {
            e.preventDefault();
            \$get(\"/cart/update/\" + ID + \"/\" + quantity, function(){
                console.log(\"Quantity updated\");
                \$(\"update\" + ID).show();
            });
        }
        
        
        \$(\"document\").ready(function(){
           \$(\".updateLink\").hide();
        });
    </script>
{% endblock %}

{% block content %}
    <table border=\"1\">
        {% for ci in cartitemList %}
            <tr>
                <td>{{ci.name}}</td>
                <td>{{ci.price}}</td>
                <td><button onclick=\"decrement({{ci.ID}})\">-</button>
                        <input type=\"number\" name=\"quantity{{ci.ID}}\"
                               value=\"{{ci.quantity}}\" style=\"width:30px;\">
                        <button onclick=\"increment({{ci.ID}})\">+</button>
                        <a href=\"\" class=\"updateLink\" id=\"update{{ci.ID}}\"
                              onclick=\"update(event,{{ci.ID}})\">update</a>
                </td>
            </tr>
        {% endfor %}
    </table>

    {% endblock %}
";
    }
}
