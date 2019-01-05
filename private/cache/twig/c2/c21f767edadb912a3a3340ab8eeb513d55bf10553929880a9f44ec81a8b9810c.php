<?php

/* register.html.twig */
class __TwigTemplate_a08df9c443c12c01101cd4f54257cb3fa9852f893a52851723530417e571214c extends Twig_Template
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
        ";
        // line 6
        echo twig_escape_filter($this->env, json_encode(($context["validation_errors"] ?? null)), "html", null, true);
        echo "
        <p>Email: <input type=\"text\" name=\"email\" > ";
        // line 7
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["validation_errors"] ?? null), "email", array()), "html", null, true);
        echo "<br></p>
        <p>Username: <input type=\"text\" name=\"username\" > ";
        // line 8
        echo twig_escape_filter($this->env, ($context["username_error"] ?? null), "html", null, true);
        echo "<br></p>
        <p>Password: <input type=\"text\" name=\"password\" > ";
        // line 9
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
        return array (  55 => 9,  51 => 8,  47 => 7,  43 => 6,  39 => 5,  35 => 3,  32 => 2,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends 'header_footer.html.twig'%}
{% block content %}
    <h3>Register A New Account</h3>

    <form action = \"{{ path_for('register') }}\" method = \"post\">
        {{ validation_errors | json_encode }}
        <p>Email: <input type=\"text\" name=\"email\" > {{ validation_errors.email }}<br></p>
        <p>Username: <input type=\"text\" name=\"username\" > {{ username_error }}<br></p>
        <p>Password: <input type=\"text\" name=\"password\" > {{ password_error }}<br></p>
        <!--<p>Password Confirm: <input type=\"text\" name=\"password_confirm\"><br></p>  THIS WILL BE IMPLEMENTED LATER-->
        <input type=\"submit\" value=\"Create Account\">
    </form>
{% endblock %}", "register.html.twig", "C:\\xampp\\htdocs\\projects\\authentication\\private\\app\\templates\\register.html.twig");
    }
}
