<?php

/* index.html.twig */
class __TwigTemplate_1f458237c7a4dcc754e73e9cd8c2354b84aaffa7777b112dcfd3c23a37448ca4 extends Twig_Template
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
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["personList"]) ? $context["personList"] : null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["person"]) {
            // line 3
            echo "    <p> ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["person"], "name", array()), "html", null, true);
            echo " is ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["person"], "age", array()), "html", null, true);
            echo " y/o.</p>
";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 5
            echo "    No persons have been found.
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['person'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
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
        return array (  34 => 5,  24 => 3,  19 => 2,);
    }

    public function getSource()
    {
        return "{# empty Twig template #}
{% for person in personList %}
    <p> {{ person.name }} is {{person.age}} y/o.</p>
{% else %}
    No persons have been found.
{% endfor %}";
    }
}
