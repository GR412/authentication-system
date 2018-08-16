<?php

/* homepage.html.twig */
class __TwigTemplate_2cdb7d5945affd01442aca1dbda11840bbbcc2f9216c715b1950c4c87c130105 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("header_footer.html.twig", "homepage.html.twig", 1);
        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "header_footer.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_content($context, array $blocks = array())
    {
        // line 3
        echo "<main>
    <h3>Welcome to CRAFT412<br/>We are currently running version 1.11.2<br/>Survival / PurePVP / GamesWorld</h3>
    <h4>SERVER TRAILER</h4>
    <iframe src=\"https://www.youtube.com/embed/dfbWw757Iow\" allowfullscreen></iframe>
</main>
";
    }

    public function getTemplateName()
    {
        return "homepage.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  35 => 3,  32 => 2,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "homepage.html.twig", "C:\\xampp\\htdocs\\projects\\authentication\\private\\app\\templates\\homepage.html.twig");
    }
}
