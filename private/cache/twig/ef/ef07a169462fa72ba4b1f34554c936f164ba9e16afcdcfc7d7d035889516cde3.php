<?php

/* register.html.twig */
class __TwigTemplate_a4afb020d32586f5c64f86eeafbe55a6f690546e34c8af1d946a07b22a8ad8a3 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("header_footer.html.twig", "register.html.twig", 1);
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
        echo "    <h3>Register A New Account</h3>

    <form action = \"";
        // line 5
        echo twig_escape_filter($this->env, $this->extensions['Slim\Views\TwigExtension']->pathFor("register"), "html", null, true);
        echo "\" method = \"post\">
        <p>Email: <input type=\"text\" name=\"email\" > ";
        // line 6
        echo twig_escape_filter($this->env, ($context["email_error"] ?? null), "html", null, true);
        echo "<br></p>
        <p>Username: <input type=\"text\" name=\"username\" > ";
        // line 7
        echo twig_escape_filter($this->env, ($context["username_error"] ?? null), "html", null, true);
        echo "<br></p>
        <p>Password: <input type=\"text\" name=\"password\" > ";
        // line 8
        echo twig_escape_filter($this->env, ($context["password_error"] ?? null), "html", null, true);
        echo "<br></p>
        <!--<p>Password Confirm: <input type=\"text\" name=\"password_confirm\"><br></p>  THIS WILL BE IMPLEMENTED LATER-->
        <input type=\"submit\" value=\"Create Account\">
    </form>
";
    }

    public function getTemplateName()
    {
        return "register.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  51 => 8,  47 => 7,  43 => 6,  39 => 5,  35 => 3,  32 => 2,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "register.html.twig", "C:\\xampp\\htdocs\\projects\\authentication\\private\\app\\templates\\register.html.twig");
    }
}
