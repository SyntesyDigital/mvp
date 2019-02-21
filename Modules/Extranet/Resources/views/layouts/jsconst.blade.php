<script>
  const MODELS = {!! json_encode(Config('models'), JSON_PRETTY_PRINT) !!};
  const ICONS = {
    "text" : 'fa-font',
    "date" : 'fa-calendar',
    "list" : 'fa-list'
  };
</script>
