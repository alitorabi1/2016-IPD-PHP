<?php

/* index.html.twig */
class __TwigTemplate_d2d5e3f51b723997dcf7f3e7c66db76fc51540911eda27c1e3553db0abe5e713 extends Twig_Template
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
        echo "All ads";
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        echo "
<a href=\"/postad\">Post an Add</a>
";
        // line 8
        if ((isset($context["adList"]) ? $context["adList"] : null)) {
            // line 9
            echo "    <table border=\"1\">
        <tr>
            <th>ID</th>
            <th>Message</th>
            <th>Price</th>
            <th>Contact Email:</th>
            <th>Operations</th>
        </tr>
            ";
            // line 17
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["adList"]) ? $context["adList"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["ad"]) {
                // line 18
                echo "            <tr>
                <td>";
                // line 19
                echo twig_escape_filter($this->env, $this->getAttribute($context["ad"], "ID", array()), "html", null, true);
                echo "</td>
                <td>";
                // line 20
                echo twig_escape_filter($this->env, $this->getAttribute($context["ad"], "msg", array()), "html", null, true);
                echo "</td>
                <td>";
                // line 21
                echo twig_escape_filter($this->env, $this->getAttribute($context["ad"], "price", array()), "html", null, true);
                echo "</td>
                <td>";
                // line 22
                echo twig_escape_filter($this->env, $this->getAttribute($context["ad"], "contactEmail", array()), "html", null, true);
                echo "</td>
                <td><a href='/postad/";
                // line 23
                echo twig_escape_filter($this->env, $this->getAttribute($context["ad"], "ID", array()), "html", null, true);
                echo "'>Edit Ad</a></td>
            </tr>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ad'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 26
            echo "    </table>
    ";
        } else {
            // line 28
            echo "        <p>There are no ads yet</p>   
";
        }
        // line 30
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
        return array (  94 => 30,  90 => 28,  86 => 26,  77 => 23,  73 => 22,  69 => 21,  65 => 20,  61 => 19,  58 => 18,  54 => 17,  44 => 9,  42 => 8,  38 => 6,  35 => 5,  29 => 3,  11 => 1,);
    }

    public function getSource()
    {
        return "{% extends \"master.html.twig\" %}

{% block title %}All ads{% endblock %}

{% block content %}

<a href=\"/postad\">Post an Add</a>
{% if adList %}
    <table border=\"1\">
        <tr>
            <th>ID</th>
            <th>Message</th>
            <th>Price</th>
            <th>Contact Email:</th>
            <th>Operations</th>
        </tr>
            {% for ad in adList %}
            <tr>
                <td>{{ad.ID}}</td>
                <td>{{ad.msg}}</td>
                <td>{{ad.price}}</td>
                <td>{{ad.contactEmail}}</td>
                <td><a href='/postad/{{ad.ID}}'>Edit Ad</a></td>
            </tr>
            {% endfor %}
    </table>
    {% else %}
        <p>There are no ads yet</p>   
{% endif %}

{% endblock %}";
    }
}
