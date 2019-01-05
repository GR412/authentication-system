<?php

/* register.html.twig */
class __TwigTemplate_a1b1277ffb1e88215b008f69fb257104a5de791756421b7814c351847f7c47d7 extends Twig_Template
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
        echo twig_escape_filter($this->env, ($context["register_action"] ?? null), "html", null, true);
        echo "\" method = \"post\">
        <p>Email: <input type=\"text\" name=\"email\" value=\"";
        // line 6
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["old"] ?? null), "email", array()), "html", null, true);
        echo "\" > ";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["validation_errors"] ?? null), "email_message", array()), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["validation_errors"] ?? null), "email_taken_message", array()), "html", null, true);
        echo " <br></p>
        <p>Username: <input type=\"text\" name=\"username\" value=\"";
        // line 7
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["old"] ?? null), "username", array()), "html", null, true);
        echo "\" > ";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["validation_errors"] ?? null), "username_message", array()), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["validation_errors"] ?? null), "username_taken_message", array()), "html", null, true);
        echo "  <br></p>
        <p>Password: <input type=\"text\" name=\"password\" > ";
        // line 8
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["validation_errors"] ?? null), "password_message", array()), "html", null, true);
        echo " <br></p>
        <p>Password Confirm: <input type=\"text\" name=\"password_confirm\"> ";
        // line 9
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["validation_errors"] ?? null), "password_confirm_message", array()), "html", null, true);
        echo "<br></p>
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
        return array (  63 => 9,  59 => 8,  51 => 7,  43 => 6,  39 => 5,  35 => 3,  32 => 2,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "register.html.twig", "C:\\xampp\\htdocs\\projects\\authentication\\private\\app\\templates\\register.html.twig");
    }
}
