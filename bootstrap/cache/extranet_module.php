<?php return array (
  'providers' => 
  array (
    0 => 'Modules\\Extranet\\Providers\\ExtranetServiceProvider',
    1 => 'Modules\\Extranet\\Providers\\MacroServiceProvider',
  ),
  'eager' => 
  array (
    0 => 'Modules\\Extranet\\Providers\\ExtranetServiceProvider',
  ),
  'deferred' => 
  array (
    'html' => 'Modules\\Extranet\\Providers\\MacroServiceProvider',
    'form' => 'Modules\\Extranet\\Providers\\MacroServiceProvider',
    'Collective\\Html\\HtmlBuilder' => 'Modules\\Extranet\\Providers\\MacroServiceProvider',
    'Collective\\Html\\FormBuilder' => 'Modules\\Extranet\\Providers\\MacroServiceProvider',
  ),
  'when' => 
  array (
    'Modules\\Extranet\\Providers\\MacroServiceProvider' => 
    array (
    ),
  ),
);