<script>
  const WEBROOT = '/';
  const ASSETS = '<?php echo e(asset('')); ?>';
  const IMAGES_FORMATS = <?php echo json_encode(config('images.formats'), JSON_PRETTY_PRINT); ?>;
  const FIELDS = <?php echo json_encode(Modules\Architect\Fields\FieldConfig::get(), JSON_PRETTY_PRINT); ?>;
  const WIDGETS = <?php echo json_encode(Modules\Architect\Widgets\WidgetConfig::get(), JSON_PRETTY_PRINT); ?>;
  const CURRENT_USER = <?php echo Auth::user() ? json_encode(Auth::user(), JSON_PRETTY_PRINT) : null; ?>;
  const LANGUAGES = <?php echo json_encode(Modules\Architect\Entities\Language::orderBy('name', 'DESC')->get(), JSON_PRETTY_PRINT); ?>;
  const TYPOLOGIES = <?php echo json_encode(Modules\Architect\Entities\Typology::all(), JSON_PRETTY_PRINT); ?>;
  const ROW_SETTINGS = ['htmlId','htmlClass','hasContainer'];
  const COL_SETTINGS = ['htmlId','htmlClass'];
  const PAGE_SETTINGS = ['htmlClass','pageType'];
  const CONTENT_SETTINGS = ['htmlClass'];
  const CATEGORIES = <?php echo json_encode(Modules\Architect\Entities\Category::all(), JSON_PRETTY_PRINT); ?>;
  const DEFAULT_LOCALE = '<?php echo e(Modules\Architect\Entities\Language::getDefault()->iso); ?>';
  const ROLES = <?php echo json_encode(config('roles'), JSON_PRETTY_PRINT); ?>;

</script>
