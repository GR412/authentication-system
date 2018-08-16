<?php

/* header_footer.html.twig */
class __TwigTemplate_6bc0203b29e16efee44d0117363a9e05bd153cec9f68d45f1115c4d3ff49dc80 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("layout.html.twig", "header_footer.html.twig", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'header' => array($this, 'block_header'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_title($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, ($context["page_title"] ?? null), "html", null, true);
    }

    // line 3
    public function block_header($context, array $blocks = array())
    {
        // line 4
        echo "    <header>
        <h1>Login App</h1>

        <form action=\"http://google.com\">
            <input type=\"submit\" value=\"Sign Up\" />
        </form>

        <form action=\"http://google.com\">
            <input type=\"submit\" value=\"Login\" />
        </form>

        <form action=\"http://google.com\">
            <input type=\"submit\" value=\"Log Out\" />
        </form>
    </header>
";
    }

    public function getTemplateName()
    {
        return "header_footer.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  42 => 4,  39 => 3,  33 => 2,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "header_footer.html.twig", "C:\\xampp\\htdocs\\projects\\authentication\\private\\app\\templates\\header_footer.html.twig");
    }
}
