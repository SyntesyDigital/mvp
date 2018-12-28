app.sitelist = {

    list_json: {},
    source: '',

    init: function() {
        list_json = [];
        if ($('input[name="value"]').val() != '') {
            list_json = JSON.parse($('input[name="value"]').val());
        }
        this.parseJson();
    },

    addNewElement: function() {
        list_json.push({
            name: "",
            value: ""
        });
        this.parseJson()
    },

    parseJson: function() {
        var node = "<div class='row' id='options-ele'>";
        for (var i = 0; i < list_json.length; i++) {
            var ele = list_json[i];
            node +=



            "<div class=\"typology-field dragable-option\" draggable=\"true\" ondragstart=\"app.sitelist.dragstart(event)\"  ondragenter=\"app.sitelist.dragenter(event)\" style=\"cursor: move; opacity: 1;\"> "+
              "<div class=\"field-type content-add \"><i class=\"fa fa-reorder\"></i> &nbsp; Element</div>"+
              "<div class=\"field-inputs content-add\">"+
                "<div class=\"row\">"+
                  "<div class=\"field-name col-xs-6\">"+
                    "<div class=\"form-group\"><input type=\"text\" class=\"form-control input-name-op\" name=\"name_json\" oninput=\"list_json[" + i + "].name = this.value;app.sitelist.updatePreview();\" placeholder=\"name\" value=\"" + ele.name + "\"><span class=\"material-input\"></span></div>"+
                  "</div>"+
                  "<div class=\"field-id col-xs-6\">"+
                    "<div class=\"form-group\"><input type=\"text\" class=\"form-control input-value-op\" name=\"value_json\" oninput=\"list_json[" + i + "].value = this.value;app.sitelist.updatePreview();\" placeholder=\"value\" value=\"" + ele.value + "\"><span class=\"material-input\"></span></div>"+
                  "</div>"+
                "</div>"+
              "</div>"+
              "<div class=\"field-actions content-add\"><a href=\"#\" onclick=\"app.sitelist.removeContent(" + i + ")\" class=\"remove-field-btn\"> <i class=\"fa fa-trash\"></i> Supprimer </a>&nbsp;&nbsp;</div>"+
            "</div>";
        }
        node +=   "<div class=\"ajouter-element dashed-border\"><a href=\"#\" class=\"btn btn-default\" id=\"ajouter\" onclick=\"app.sitelist.addNewElement()\"><i class=\"fa fa-plus\"></i> AJOUTER</a></div>";
        node += "</div>"
        $('.content-field-dropper').html(node);
        this.updatePreview();

    },

    dragstart: function(e) {
        source = e.target;
        e.dataTransfer.effectAllowed = 'move';
    },

    dragover: function(e) {
        e.preventDefault();
    },


    isbefore: function(a, b) {
        if (a.parentNode == b.parentNode) {
            for (var cur = a; cur; cur = cur.previousSibling) {
                if (cur === b) {
                    return true;
                }
            }
        }
        return false;
    },


    dragenter: function(e) {
        var targetelem = e.target;
        if (source.nodeName == 'INPUT') {
            return false
        } else {
            if (targetelem.getAttribute('class') != "typology-field dragable-option") {
                targetelem = targetelem.closest('.dragable-option');
            }
            if (this.isbefore(source, targetelem)) {
                targetelem.parentNode.insertBefore(source, targetelem);
            } else {
                targetelem.parentNode.insertBefore(source, targetelem.nextSibling);
            }
        }

    },

    drop: function(e) {
        var options = document.getElementsByClassName("dragable-option");
        list_json = [];
        for (var i = 0; i < options.length; i++) {
            list_json.push({
                name: options[i].getElementsByClassName("input-name-op")[0].value,
                value: options[i].getElementsByClassName("input-value-op")[0].value
            });
        }
        this.parseJson();
    },
    removeContent: function(i) {
      event.preventDefault();
      var self = this;
      bootbox.confirm({
          message: 'Etes-vous sur de vouloir supprimer cette content ?',
          buttons: {
              confirm: {
                  label: 'Oui',
                  className: 'btn-primary'
              },
              cancel: {
                  label: 'Non',
                  className: 'btn-default'
              }
          },
          callback: function(result) {
              if (result) {
                list_json.splice(i, 1);
                self.parseJson();
              }
          }
      });
    },
    updatePreview: function() {
        var type = $('#type').val(),
            name = $('#name').val();

        if (name == '') {
            name = 'Titre';
        }
        preview_html = "<div class='form-group'>" +
            "<label for='preview'>" + name + "</label>";

        switch (type) {
            case 'select':
                preview_html += "<select name='' class='form-control'>";
                for (var i = 0; i < list_json.length; i++) {
                    preview_html += "<option value='" + list_json[i].value + "'>" + list_json[i].name + "</option>";
                }
                preview_html += "</select>";
                break;
            case 'checkbox':
                for (var i = 0; i < list_json.length; i++) {
                    preview_html += "<div class='checkbox'>" +
                        "<label style='font-size: .8em'>" +
                        "<input type='checkbox' name='' value='" + list_json[i].value + "'>" +
                        "<span class='checkbox-material'><span class='check'></span></span>" +
                        list_json[i].name +
                        "</label>" +
                        "</div>";
                }
                break;
            case 'radios':
                for (var i = 0; i < list_json.length; i++) {
                    preview_html += "<div class='radio'>" +
                        "<label style='font-size: .8em'>" +
                        "<input type='radio' name='' value='" + list_json[i].value + "'>" +
                        "<span class='circle'></span><span class='check'></span>" +
                        list_json[i].name +
                        "</label>" +
                        "</div>";
                }
                break;
            default:
                break;
        }

        preview_html += "</div>"

        $('#preview').html(preview_html);
        $('input[name="value"]').val(JSON.stringify(list_json));
    },


}

$('#general-delete-btn').on('click', function(e) {
  e.preventDefault();
  bootbox.confirm({
      message: 'Etes-vous sur de vouloir supprimer cette List ?',
      buttons: {
          confirm: {
              label: 'Oui',
              className: 'btn-primary'
          },
          cancel: {
              label: 'Non',
              className: 'btn-default'
          }
      },
      callback: function(result) {
          if (result) {
              $('form.delete-sitelist-form')
                  .off('submit')
                  .trigger('submit');
          }
      }
  });
});
