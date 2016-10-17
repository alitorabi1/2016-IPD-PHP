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


    ";
        // line 10
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["productList"]) ? $context["productList"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["product"]) {
            // line 11
            echo "        <hr><div><h3>";
            echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "name", array()), "html", null, true);
            echo "</h3>
                <img height=\"100\" src=\"/images/";
            // line 12
            echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "imagePath", array()), "html", null, true);
            echo "\">
                <p>";
            // line 13
            echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "description", array()), "html", null, true);
            echo "</p>
                <p>Price per unit ";
            // line 14
            echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "price", array()), "html", null, true);
            echo "</p>
                <form method=\"post\" action=\"/cart\">
                <input type=\"hidden\" name=\"productID\" value=\"";
            // line 16
            echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "ID", array()), "html", null, true);
            echo "\">
                Add to cart <input name=\"quantity\" type=\"number\" value=\"1\" size=\"2\" style=\"width: 30px;\">
                <input type=\"submit\" value=\"Add to cart\">
                </form>
                </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 22
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
        return array (  78 => 22,  66 => 16,  61 => 14,  57 => 13,  53 => 12,  48 => 11,  44 => 10,  38 => 6,  35 => 5,  29 => 3,  11 => 1,);
    }

    public function getSource()
    {
        return "{% extends \"master.html.twig\" %}

{% block title %}Home{% endblock %}

{% block content %}

<h7>You may <a href=\"/register\">Register</a> or <a href=\"/login\">Login</a> or <a href=\"/logout\">Log out</a></h7>


    {% for product in productList%}
        <hr><div><h3>{{product.name}}</h3>
                <img height=\"100\" src=\"/images/{{product.imagePath}}\">
                <p>{{product.description}}</p>
                <p>Price per unit {{product.price}}</p>
                <form method=\"post\" action=\"/cart\">
                <input type=\"hidden\" name=\"productID\" value=\"{{product.ID}}\">
                Add to cart <input name=\"quantity\" type=\"number\" value=\"1\" size=\"2\" style=\"width: 30px;\">
                <input type=\"submit\" value=\"Add to cart\">
                </form>
                </div>
    {% endfor %}

{% endblock %}
";
    }
}
