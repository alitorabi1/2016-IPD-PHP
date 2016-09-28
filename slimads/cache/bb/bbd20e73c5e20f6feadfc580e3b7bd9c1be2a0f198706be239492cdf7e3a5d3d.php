<?php

/* index.html.twig */
class __TwigTemplate_d2d5e3f51b723997dcf7f3e7c66db76fc51540911eda27c1e3553db0abe5e713 extends Twig_Template
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
<h3><a href=\"index.php/postad\">Post Ad</a></h3>

<table border='1'>
";
        // line 6
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["adList"]) ? $context["adList"] : null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["ad"]) {
            // line 7
            echo "    <tr><td> ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["ad"], "msg", array()), "html", null, true);
            echo " </td><td> ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["ad"], "price", array()), "html", null, true);
            echo " </td><td> ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["ad"], "contactEmail", array()), "html", null, true);
            echo " </td></tr>
";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 9
            echo "    <tr><td colspan='2'>No ads have been found</td><td><a href=\"index.php/postad\">Post Ad</a></td></tr>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ad'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 11
        echo "</table>";
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
        return array (  49 => 11,  42 => 9,  30 => 7,  25 => 6,  19 => 2,);
    }

    public function getSource()
    {
        return "{# empty Twig template #}

<h3><a href=\"index.php/postad\">Post Ad</a></h3>

<table border='1'>
{% for ad in adList %}
    <tr><td> {{ ad.msg }} </td><td> {{ad.price}} </td><td> {{ad.contactEmail}} </td></tr>
{% else %}
    <tr><td colspan='2'>No ads have been found</td><td><a href=\"index.php/postad\">Post Ad</a></td></tr>
{% endfor %}
</table>";
    }
}
