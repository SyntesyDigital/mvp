$(function(){
    icons_trans = {
        "text":"i-cursor",
        "richtext":"file-text-o",
        "date":"calendar",
        "image":"image", "images":"th",
        "select":"cube",
        "select-multiple":"cubes",
        "array_content":"sitemap",
        "titletextimage":"newspaper-o",
        "map":"map-o",
        "map-story":"map-marker"
    }

    updateJsonValues = (ev,id,key,thetype,old) => {
        console.log(key, ev.target.value);

        if(ev.target.value != old){
            ///console.log('old: ' +architect_content[id][key]);
            if(key == 'label'){
                architect_content[id] = {name:architect_content[id].name,label:ev.target.value,type:thetype};
            } else if(key == 'name'){
                architect_content[id] = {name:ev.target.value,label:architect_content[id].label,type:thetype};
            }
            parseJson();
            updateCurrentJson();
        }

        // if(key == "index") {
        //     Object.assign(architect_content[id], {
        //         index : ev.target.value !== 'undefined' || ev.target.value ? true : false
        //     });
        //     parseJson();
        //     updateCurrentJson();
        // }
    }

    toggleEditor = mode =>{
        if(mode == "visual"){
            $( ".tab-visual" ).addClass('active');
            $( ".tab-json" ).removeClass('active');
            $( ".content-field-dropper" ).show();
            $( ".content-json-editor" ).hide();
        }else{
            $( ".tab-json" ).addClass('active');
            $( ".tab-visual" ).removeClass('active');
            $( ".content-field-dropper" ).hide();
            $( ".content-json-editor" ).show();
        }
    }


    /**
    *   when dropping over
    *
    *   @param ev DragEvent
    *
    **/
    allowDrop = ev =>  {
        ev.preventDefault();
    }


    /**
    *   upon dragging
    *
    *   @param ev DragEvent
    *
    **/
    drag = ev =>  {
        var type = ev.target.attributes['aria-data'].value;
        //  console.log(ev.target.attributes['aria-data'].value);
        // console.log(ev);
        ev.dataTransfer.setData("content_type", type);
    }

    /**
    *   upon dropping
    *
    *   @param ev DragEvent
    *
    **/
    drop = ev =>  {
        ev.preventDefault();
        var data = ev.dataTransfer.getData("content_type");
        console.log(ev);
        console.log(data);
        typesSwitcher(data);
        //ev.target.appendChild(document.getElementById(data));
        parseJson(true);
    }

    /**
    *   parses the current json and updates the visual area.
    *
    *   @param ev DragEvent
    *
    **/

    parseJson = (clean = true) => {
        if(clean){
            $( "textarea#jsonviewer" ).empty();
        }
        var node = "<div class='row'>";
        for (var i = 0; i < architect_content.length; i++) {
            //    Things[i]
            //}
            //for (var i = 0; i < architect_content.length; i++) {
            var ele = architect_content[i];
            //console.log(ele);
            node += "<div class='col-md-12'>"
                +"<div class='content-add content-type-"+ele.type+"' >"
                    +"<div class='tool-box'>"
                        +"<a onclick='removeContent("+i+")'><i class='fa fa-remove'></i></a>"
                    +"</div>"
                    +"<i class='fa fa-"+icons_trans[ele.type]+"' ></i> "
                    +"<h4>" + ele.label + "</h4>"

                    +"<div class='form-group'>"
                        +"<label>Label</label>"
                        +"<input type='text' class='form-control input-lg' value='"+ele.label+"' onfocusout='updateJsonValues(event,"+i+", \"label\",\""+ele.type+"\",\""+ele.label+"\")' />"

                        +"<label>Identifiant</label>"
                        +"<input type='text' class='form-control input-sm' value='"+ele.name+"' onfocusout='updateJsonValues(event,"+i+", \"name\",\""+ele.type+"\",\""+ele.name+"\")' />";

                    // if(ele.type == 'text') {
                    //     console.log(ele.index);
                    //     var checked = ele.index ? 'checked' : '';
                    //     node += "<label><input type='checkbox' class='' value='"+ele.index+"' " + checked + "  onfocusout='updateJsonValues(event,"+i+", \"index\",\""+ele.type+"\",\""+ele.name+"\")' /> Utiliser ce champs comme titre ? </label>";
                    // }

                node += "</div>"

                +"</div>"
            +"</div>";
            //$( "textarea#jsonviewer" ).append( node );

        }
        node += "</div>"
        $('.content-field-dropper').html( node );
    }

    typesSwitcher = contentType => {
        var typeCounter = smartCount(contentType);
        switch(contentType){
            case 'text':
                architect_content.push({name: "text_"+typeCounter, type: "text", label: "Texto "+typeCounter});
                break;
            case 'richtext':
                architect_content.push({name:"richtext_"+typeCounter,type:"richtext",label:"Richtext "+typeCounter});

                break;
            case 'image':
                architect_content.push({name:"image_"+typeCounter,type:"image",label:"Image "+typeCounter});
                break;

            case 'images':
                architect_content.push({name:"images_"+typeCounter,type:"images",label:"Images "+typeCounter});
                break;

            case 'select':
                architect_content.push({name:"select_"+typeCounter,type:"select",label:"Image "+typeCounter});
                break;

            case 'date':
                architect_content.push( {"name":"date_"+typeCounter,"type":"date","label":"Date "+typeCounter});
               // console.log('setting up images');
                break;


            default:
                //console.log('DEFAULT: ' + contentType);
                break;
        }
        updateCurrentJson()


    }

    updateCurrentJson = () => {
        $('textarea#jsonviewer').val( JSON.stringify( architect_content ) );
        $('input[name="definition"]').val( JSON.stringify( architect_content ) );
    }

    counters = [];
    smartCount = contentType => {
        if(!counters[contentType]){
            counters[contentType] = 1;
        }else{
            counters[contentType]++;
        }
        return counters[contentType];
    }

    removeContent = indexElement => {
        architect_content.splice(indexElement,1);
        parseJson();
        updateCurrentJson();
    }

    countCurrentFieldsTypes = () =>{
        for (var i = architect_content.length - 1; i >= 0; i--) {
            smartCount(architect_content[i].type);
        }
    }

    if(architect_content.length){
        parseJson();
        updateCurrentJson();
        countCurrentFieldsTypes()

    }
    toggleEditor('visual');

    $('textarea#jsonviewer').change(function(e){

      //update content

    });


});
