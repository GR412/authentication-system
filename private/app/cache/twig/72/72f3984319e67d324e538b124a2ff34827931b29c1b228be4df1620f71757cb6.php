<?php

/* display_user.html.twig */
class __TwigTemplate_d9b2c5e2bb5f0443ecf4f4b6983ad7c4fac6b4617a797355f0878c80a35e2103 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("header_footer.html.twig", "display_user.html.twig", 1);
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
        echo "    <main>
        <p>Your username is: ";
        // line 4
        echo twig_escape_filter($this->env, ($context["username"] ?? null), "html", null, true);
        echo "</p>

        <p>Your email is: ";
        // line 6
        echo twig_escape_filter($this->env, ($context["email"] ?? null), "html", null, true);
        echo " </p>

        <p>Your hashed password is: ";
        // line 8
        echo twig_escape_filter($this->env, ($context["hashed_password"] ?? null), "html", null, true);
        echo " </p>
    </main>
";
    }

    public function getTemplateName()
    {
        return "display_user.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  48 => 8,  43 => 6,  38 => 4,  35 => 3,  32 => 2,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "display_user.html.twig", "C:\\xampp\\htdocs\\projects\\authentication\\private\\app\\templates\\display_user.html.twig");
    }
}
