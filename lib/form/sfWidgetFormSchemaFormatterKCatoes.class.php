<?php

class sfWidgetFormSchemaFormatterKCatoes extends sfWidgetFormSchemaFormatterList
{

  protected
    $rowFormat       = "<li>\n  %error%%label%\n  %field%%help%\n%hidden_fields%</li>\n",
    $errorRowFormat  = "<li>\n%errors%</li>\n",
    $helpFormat      = '<span class="aideChamp">%help%</span>',
    $decoratorFormat = "<ul>\n  %content%</ul>";


}