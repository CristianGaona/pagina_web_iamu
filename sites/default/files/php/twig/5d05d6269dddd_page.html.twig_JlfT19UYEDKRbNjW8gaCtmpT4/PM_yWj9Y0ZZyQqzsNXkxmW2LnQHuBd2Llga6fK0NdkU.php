<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* themes/onepage_zymphonies_theme/templates/layout/page.html.twig */
class __TwigTemplate_e594f984423a72c16d367e5573a5acd997c37f1cf482d963353cb6415acae97b extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["if" => 62, "for" => 125];
        $filters = ["escape" => 70, "raw" => 126, "date" => 436];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['if', 'for'],
                ['escape', 'raw', 'date'],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->getSourceContext());

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 60
        echo "

";
        // line 62
        if (($this->getAttribute(($context["page"] ?? null), "contact_email", []) || $this->getAttribute(($context["page"] ?? null), "top_menu", []))) {
            // line 63
            echo "  <div class=\"top-menu\">
    <div class=\"container\">
      <div class=\"row\">

        <!-- Start: Contact Phone & Email -->
        <div class=\"col-sm-8\">
          ";
            // line 69
            if ($this->getAttribute(($context["page"] ?? null), "contact_email", [])) {
                // line 70
                echo "            ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "contact_email", [])), "html", null, true);
                echo "
          ";
            }
            // line 72
            echo "        </div>
        <!-- End: Contact Phone & Email -->

        <!-- Start: Top menu -->
        <div class=\"col-sm-4\">
          ";
            // line 77
            if ($this->getAttribute(($context["page"] ?? null), "top_menu", [])) {
                // line 78
                echo "            ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "top_menu", [])), "html", null, true);
                echo "
          ";
            }
            // line 80
            echo "        </div>
        <!-- End: Top menu -->

      </div>
    </div>
  </div>
";
        }
        // line 87
        echo "

<header class=\"main-header\">
  <nav class=\"navbar topnav navbar-default\" role=\"navigation\">
    <div class=\"container\">
      <div class=\"row\">

        <!-- Start: Header -->
        <div class=\"navbar-header col-md-3\">
          <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#main-navigation\">
            <span class=\"sr-only\">Toggle navigation</span>
            <span class=\"icon-bar\"></span>
            <span class=\"icon-bar\"></span>
            <span class=\"icon-bar\"></span>
          </button>
          ";
        // line 102
        if ($this->getAttribute(($context["page"] ?? null), "header", [])) {
            // line 103
            echo "            ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "header", [])), "html", null, true);
            echo "
          ";
        }
        // line 105
        echo "        </div>
        <!-- End: Header -->

        <!-- Start: Main menu -->
        <div class=\"col-md-9\">
          ";
        // line 110
        if ($this->getAttribute(($context["page"] ?? null), "primary_menu", [])) {
            // line 111
            echo "            ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "primary_menu", [])), "html", null, true);
            echo "
          ";
        }
        // line 113
        echo "        </div>

        </div>
      </div>
    </nav>
</header>


<!-- Start: Slider -->
  ";
        // line 122
        if ((($context["is_front"] ?? null) && ($context["show_slideshow"] ?? null))) {
            // line 123
            echo "    <div class=\"flexslider wow bounceInUp\">
      <ul class=\"slides\">
        ";
            // line 125
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["slider_content"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["slider_contents"]) {
                // line 126
                echo "          ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->sandbox->ensureToStringAllowed($context["slider_contents"]));
                echo "
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['slider_contents'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 128
            echo "      </ul>
    </div>
  ";
        }
        // line 131
        echo "<!-- End: Slider -->


<!-- Start: Home page message -->
  ";
        // line 135
        if ((($context["is_front"] ?? null) && ((($this->getAttribute(($context["page"] ?? null), "topwidget_first", []) || $this->getAttribute(($context["page"] ?? null), "topwidget_second", [])) || $this->getAttribute(($context["page"] ?? null), "topwidget_third", [])) || $this->getAttribute(($context["page"] ?? null), "homepagemessage", [])))) {
            // line 136
            echo "    <div class=\"parallax-widget zero\" id=\"about\">
      <div class=\"container\">
        <div class=\"parallax-region wow bounceInDown\">

          <!-- Start: Home page message -->
          ";
            // line 141
            if ((($context["is_front"] ?? null) && $this->getAttribute(($context["page"] ?? null), "homepagemessage", []))) {
                // line 142
                echo "            ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "homepagemessage", [])), "html", null, true);
                echo "
          ";
            }
            // line 144
            echo "          <!--End: Home page message -->

          ";
            // line 146
            if ((($context["is_front"] ?? null) && (($this->getAttribute(($context["page"] ?? null), "topwidget_first", []) || $this->getAttribute(($context["page"] ?? null), "topwidget_second", [])) || $this->getAttribute(($context["page"] ?? null), "topwidget_third", [])))) {
                // line 147
                echo "            <div class=\"row- clearfix topwidget\">

              <!-- Start: Top wid
              get first -->          
              ";
                // line 151
                if ($this->getAttribute(($context["page"] ?? null), "topwidget_first", [])) {
                    // line 152
                    echo "                <div class = ";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["topwidget_class"] ?? null)), "html", null, true);
                    echo ">";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "topwidget_first", [])), "html", null, true);
                    echo "</div>
              ";
                }
                // line 153
                echo "          
              <!-- End: Top widget first --> 

              <!-- Start: Top widget second -->          
              ";
                // line 157
                if ($this->getAttribute(($context["page"] ?? null), "topwidget_second", [])) {
                    // line 158
                    echo "                <div class = ";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["topwidget_class"] ?? null)), "html", null, true);
                    echo ">";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "topwidget_second", [])), "html", null, true);
                    echo "</div>
              ";
                }
                // line 159
                echo "          
              <!-- End: Top widget second --> 
              
              <!-- Start: Top widget third -->         
              ";
                // line 163
                if ($this->getAttribute(($context["page"] ?? null), "topwidget_third", [])) {
                    // line 164
                    echo "                <div class = ";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["topwidget_third_class"] ?? null)), "html", null, true);
                    echo ">";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "topwidget_third", [])), "html", null, true);
                    echo "</div>
              ";
                }
                // line 165
                echo "          
              <!-- End: Top widget third -->

            </div>
          ";
            }
            // line 170
            echo "
        </div>
      </div>
    </div>
  ";
        }
        // line 175
        echo "<!--End: Home page message -->


<!-- Start: xxx -->
<div class=\"parallax-widget one\">
  <div class=\"parallax-region- wow bounceInDown\">
    
    ";
        // line 182
        if ($this->getAttribute(($context["page"] ?? null), "highlighted", [])) {
            // line 183
            echo "      <div class=\"container\">
        <div class=\"row\">
          <div class=\"col-md-12\">
            ";
            // line 186
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "highlighted", [])), "html", null, true);
            echo "
          </div>
        </div>
      </div>
    ";
        }
        // line 191
        echo "
    ";
        // line 192
        if (($this->getAttribute(($context["page"] ?? null), "page_title", []) &&  !($context["is_front"] ?? null))) {
            // line 193
            echo "      <div id=\"page-title\">
        <div id=\"page-title-inner\">
          <div class=\"container\">
            <div class=\"row\">
              <div class=\"col-md-12\">
                ";
            // line 198
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "page_title", [])), "html", null, true);
            echo "
              </div>
            </div>
          </div>
        </div>
      </div>
    ";
        }
        // line 205
        echo "
    <div class=\"container\">
      <div class=\"parallax-region\">

        ";
        // line 209
        if ( !($context["is_front"] ?? null)) {
            // line 210
            echo "          <div class=\"row\">
            <div class=\"col-md-12\">";
            // line 211
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "breadcrumb", [])), "html", null, true);
            echo "</div>
          </div>
        ";
        }
        // line 214
        echo "
        <div class=\"row layout\">

          ";
        // line 217
        if ($this->getAttribute(($context["page"] ?? null), "sidebar_first", [])) {
            // line 218
            echo "            <div class=\"sidebar\">
              <div class=";
            // line 219
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["sidebarfirst"] ?? null)), "html", null, true);
            echo "> ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "sidebar_first", [])), "html", null, true);
            echo " </div>
            </div>
          ";
        }
        // line 222
        echo "
          ";
        // line 223
        if ($this->getAttribute(($context["page"] ?? null), "content", [])) {
            // line 224
            echo "            <div class=\"content_layout\">
              <div class=";
            // line 225
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["contentlayout"] ?? null)), "html", null, true);
            echo "> ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "content", [])), "html", null, true);
            echo " </div>
            </div>
          ";
        }
        // line 228
        echo "
          ";
        // line 229
        if ($this->getAttribute(($context["page"] ?? null), "sidebar_second", [])) {
            // line 230
            echo "            <div class=\"sidebar\">
              <div class=";
            // line 231
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["sidebarsecond"] ?? null)), "html", null, true);
            echo "> ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "sidebar_second", [])), "html", null, true);
            echo " </div>
            </div>
          ";
        }
        // line 234
        echo "
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End: xxx -->


<!-- Start: Home page message -->
  ";
        // line 244
        if ((($context["is_front"] ?? null) && $this->getAttribute(($context["page"] ?? null), "services", []))) {
            // line 245
            echo "    <div class=\"parallax-widget two\" id=\"services\">
      <div class=\"container\">
        <div class=\"parallax-region wow bounceInDown\">
          <div class=\"row\">
            <div class=\"col-md-12\">
              ";
            // line 250
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "services", [])), "html", null, true);
            echo "
            </div>
          </div>
        </div>
      </div>
    </div>
  ";
        }
        // line 257
        echo "<!--End: Home page message -->


<!-- Start: Home page message -->
";
        // line 261
        if ((($context["is_front"] ?? null) && ((($this->getAttribute(($context["page"] ?? null), "bottom_first", []) || $this->getAttribute(($context["page"] ?? null), "bottom_second", [])) || $this->getAttribute(($context["page"] ?? null), "bottom_third", [])) || $this->getAttribute(($context["page"] ?? null), "bottom_forth", [])))) {
            // line 262
            echo "  <div class=\"parallax-widget four\" id=\"products\">    
    <div class=\"container\">
      <div class=\"parallax-region wow bounceInDown\">
        <div class=\"row\">

          <!-- Start: Bottom First -->          
          ";
            // line 268
            if ($this->getAttribute(($context["page"] ?? null), "bottom_first", [])) {
                // line 269
                echo "            <div class = ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["bottom_class"] ?? null)), "html", null, true);
                echo ">
              ";
                // line 270
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "bottom_first", [])), "html", null, true);
                echo "
            </div>
          ";
            }
            // line 272
            echo "          
          <!-- End: Bottom First -->

          <!-- Start: Bottom Second -->
          ";
            // line 276
            if ($this->getAttribute(($context["page"] ?? null), "bottom_second", [])) {
                // line 277
                echo "            <div class = ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["bottom_class"] ?? null)), "html", null, true);
                echo ">
              ";
                // line 278
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "bottom_second", [])), "html", null, true);
                echo "
            </div>
          ";
            }
            // line 280
            echo "          
          <!-- End: Bottom Second -->

          <!-- Start: Bottom third -->          
          ";
            // line 284
            if ($this->getAttribute(($context["page"] ?? null), "bottom_third", [])) {
                // line 285
                echo "            <div class = ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["bottom_class"] ?? null)), "html", null, true);
                echo ">
              ";
                // line 286
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "bottom_third", [])), "html", null, true);
                echo "
            </div>
          ";
            }
            // line 288
            echo "          
          <!-- End: Bottom Third -->

          <!-- Start: Bottom Forth -->
          ";
            // line 292
            if ($this->getAttribute(($context["page"] ?? null), "bottom_forth", [])) {
                // line 293
                echo "            <div class = ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["bottom_class"] ?? null)), "html", null, true);
                echo ">
              ";
                // line 294
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "bottom_forth", [])), "html", null, true);
                echo "
            </div>
          ";
            }
            // line 297
            echo "          <!-- End: Bottom Forth -->

        </div>
      </div>
    </div>
  </div>
";
        }
        // line 304
        echo "<!--End: Home page message -->


<!-- Start: Home page message -->
  ";
        // line 308
        if ((($context["is_front"] ?? null) && $this->getAttribute(($context["page"] ?? null), "clients", []))) {
            // line 309
            echo "    <div class=\"parallax-widget three\" id=\"clients\">
      <div class=\"container\">
        <div class=\"parallax-region wow bounceInDown\">
          <div class=\"row\">
            <div class=\"col-md-12\">
              ";
            // line 314
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "clients", [])), "html", null, true);
            echo "
            </div>
          </div>
        </div>
      </div>
    </div>
  ";
        }
        // line 321
        echo "<!--End: Home page message -->


<!-- Start: Home page message -->
";
        // line 325
        if ((($context["is_front"] ?? null) && (($this->getAttribute(($context["page"] ?? null), "footer_first", []) || $this->getAttribute(($context["page"] ?? null), "footer_second", [])) || $this->getAttribute(($context["page"] ?? null), "footer_third", [])))) {
            // line 326
            echo "  <div class=\"parallax-widget six\" id=\"footer\">
    <div class=\"container\">
      <div class=\"parallax-region wow bounceInUp\">  
        <div class=\"row\">

          <!-- Start: Footer First -->
          ";
            // line 332
            if ($this->getAttribute(($context["page"] ?? null), "footer_first", [])) {
                // line 333
                echo "            <div class = ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["footer_first_class"] ?? null)), "html", null, true);
                echo ">
              ";
                // line 334
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer_first", [])), "html", null, true);
                echo "
            </div>
          ";
            }
            // line 337
            echo "          <!-- End: Footer First -->

          <!-- Start :Footer Second -->
          ";
            // line 340
            if ($this->getAttribute(($context["page"] ?? null), "footer_second", [])) {
                // line 341
                echo "            <div class = ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["footer_class"] ?? null)), "html", null, true);
                echo ">
              ";
                // line 342
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer_second", [])), "html", null, true);
                echo "
            </div>
          ";
            }
            // line 345
            echo "          <!-- End: Footer Second -->

          <!-- Start: Footer third -->
          ";
            // line 348
            if ($this->getAttribute(($context["page"] ?? null), "footer_third", [])) {
                // line 349
                echo "            <div class = ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["footer_class"] ?? null)), "html", null, true);
                echo ">
              ";
                // line 350
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer_third", [])), "html", null, true);
                echo "
            </div>
          ";
            }
            // line 353
            echo "          <!-- End: Footer Third -->

        </div>
      </div>
    </div>
  </div>
";
        }
        // line 360
        echo "<!--End: Home page message -->


<!-- Start: Home page message -->
";
        // line 364
        if (((($context["is_front"] ?? null) && $this->getAttribute(($context["page"] ?? null), "google_map", [])) && $this->getAttribute(($context["page"] ?? null), "address", []))) {
            // line 365
            echo "  <div class=\"parallax-widget five map-and-address\" id=\"contact\">
    <div class=\"container\">
      <div class=\"parallax-region wow bounceInUp\">
        <div class=\"row\">
          <div class=\"col-md-6\">
            <!-- Start: Google map -->
            ";
            // line 371
            if ($this->getAttribute(($context["page"] ?? null), "google_map", [])) {
                // line 372
                echo "              <div class=\"google_map\">";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "google_map", [])), "html", null, true);
                echo "</div>
            ";
            }
            // line 374
            echo "            <!-- End: Google map -->
          </div>
          <div class=\"col-md-6\">
            <!-- Start: Address -->
            ";
            // line 378
            if ($this->getAttribute(($context["page"] ?? null), "address", [])) {
                // line 379
                echo "              <div class=\"address-wrap\">";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "address", [])), "html", null, true);
                echo "</div>
            ";
            }
            // line 381
            echo "          <!--End: Address -->
          </div>
        </div>
      </div>
    </div>
  </div>
  ";
        }
        // line 388
        echo "<!--End: Home page message -->


<!-- Start: Footer Menu -->
";
        // line 392
        if (($context["show_social_icon"] ?? null)) {
            // line 393
            echo "  <div class=\"footer-menu\">
    <div class=\"container\">
      <div class=\"row\">

        <!-- Start: Social media links -->
        <div class=\"col-sm-12\">
          <div class=\"social-media\">
            ";
            // line 400
            if (($context["facebook_url"] ?? null)) {
                // line 401
                echo "              <a href=\"";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["facebook_url"] ?? null)), "html", null, true);
                echo "\"  class=\"facebook\" target=\"_blank\" ><i class=\"fa fa-facebook\"></i></a>
            ";
            }
            // line 403
            echo "            ";
            if (($context["google_plus_url"] ?? null)) {
                // line 404
                echo "              <a href=\"";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["google_plus_url"] ?? null)), "html", null, true);
                echo "\"  class=\"google-plus\" target=\"_blank\" ><i class=\"fa fa-google-plus\"></i></a>
            ";
            }
            // line 406
            echo "            ";
            if (($context["twitter_url"] ?? null)) {
                // line 407
                echo "              <a href=\"";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["twitter_url"] ?? null)), "html", null, true);
                echo "\" class=\"twitter\" target=\"_blank\" ><i class=\"fa fa-twitter\"></i></a>
            ";
            }
            // line 409
            echo "            ";
            if (($context["linkedin_url"] ?? null)) {
                // line 410
                echo "              <a href=\"";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["linkedin_url"] ?? null)), "html", null, true);
                echo "\" class=\"linkedin\" target=\"_blank\"><i class=\"fa fa-linkedin\"></i></a>
            ";
            }
            // line 412
            echo "            ";
            if (($context["pinterest_url"] ?? null)) {
                // line 413
                echo "              <a href=\"";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["pinterest_url"] ?? null)), "html", null, true);
                echo "\" class=\"pinterest\" target=\"_blank\" ><i class=\"fa fa-pinterest\"></i></a>
            ";
            }
            // line 415
            echo "            ";
            if (($context["rss_url"] ?? null)) {
                // line 416
                echo "              <a href=\"";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["rss_url"] ?? null)), "html", null, true);
                echo "\" class=\"rss\" target=\"_blank\" ><i class=\"fa fa-rss\"></i></a>
            ";
            }
            // line 418
            echo "          </div>
        </div>
        <!-- End: Social media links -->

      </div>
    </div>
  </div>
";
        }
        // line 426
        echo "<!-- End: Footer Menu -->


<!-- Start: Copyright -->
<div class=\"copyright\">
  <div class=\"container\">
    <div class=\"row\">

      <!-- Start: Copyright -->
      <div class=\"col-sm-6\">
        <p>Copyright © ";
        // line 436
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, twig_date_format_filter($this->env, "now", "Y"), "html", null, true);
        echo ". All rights reserved.</p>
      </div>
      <!-- End: Copyright -->

      <!-- Start: Credit link -->
      ";
        // line 441
        if (($context["show_credit_link"] ?? null)) {
            // line 442
            echo "        <div class=\"col-sm-6\">
          <p class=\"credit-link\">Designed By <a href=\"http://www.zymphonies.com\" target=\"_blank\">Zymphonies</a></p>
        </div>
      ";
        }
        // line 446
        echo "      <!-- End: Credit link -->
      
    </div>
  </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "themes/onepage_zymphonies_theme/templates/layout/page.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  760 => 446,  754 => 442,  752 => 441,  744 => 436,  732 => 426,  722 => 418,  716 => 416,  713 => 415,  707 => 413,  704 => 412,  698 => 410,  695 => 409,  689 => 407,  686 => 406,  680 => 404,  677 => 403,  671 => 401,  669 => 400,  660 => 393,  658 => 392,  652 => 388,  643 => 381,  637 => 379,  635 => 378,  629 => 374,  623 => 372,  621 => 371,  613 => 365,  611 => 364,  605 => 360,  596 => 353,  590 => 350,  585 => 349,  583 => 348,  578 => 345,  572 => 342,  567 => 341,  565 => 340,  560 => 337,  554 => 334,  549 => 333,  547 => 332,  539 => 326,  537 => 325,  531 => 321,  521 => 314,  514 => 309,  512 => 308,  506 => 304,  497 => 297,  491 => 294,  486 => 293,  484 => 292,  478 => 288,  472 => 286,  467 => 285,  465 => 284,  459 => 280,  453 => 278,  448 => 277,  446 => 276,  440 => 272,  434 => 270,  429 => 269,  427 => 268,  419 => 262,  417 => 261,  411 => 257,  401 => 250,  394 => 245,  392 => 244,  380 => 234,  372 => 231,  369 => 230,  367 => 229,  364 => 228,  356 => 225,  353 => 224,  351 => 223,  348 => 222,  340 => 219,  337 => 218,  335 => 217,  330 => 214,  324 => 211,  321 => 210,  319 => 209,  313 => 205,  303 => 198,  296 => 193,  294 => 192,  291 => 191,  283 => 186,  278 => 183,  276 => 182,  267 => 175,  260 => 170,  253 => 165,  245 => 164,  243 => 163,  237 => 159,  229 => 158,  227 => 157,  221 => 153,  213 => 152,  211 => 151,  205 => 147,  203 => 146,  199 => 144,  193 => 142,  191 => 141,  184 => 136,  182 => 135,  176 => 131,  171 => 128,  162 => 126,  158 => 125,  154 => 123,  152 => 122,  141 => 113,  135 => 111,  133 => 110,  126 => 105,  120 => 103,  118 => 102,  101 => 87,  92 => 80,  86 => 78,  84 => 77,  77 => 72,  71 => 70,  69 => 69,  61 => 63,  59 => 62,  55 => 60,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/onepage_zymphonies_theme/templates/layout/page.html.twig", "C:\\xampp\\htdocs\\ing_web_2019_cd\\Observatorio_gestion_ambiental\\iamu\\themes\\onepage_zymphonies_theme\\templates\\layout\\page.html.twig");
    }
}
