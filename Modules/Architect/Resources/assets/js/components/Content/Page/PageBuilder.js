import React, {Component} from 'react';
import { render } from 'react-dom';

import TextField from './../ContentFields/TextField';
import SlugField from './../ContentFields/SlugField';

import FirstEmptyRow from './RowTypes/FirstEmptyRow';
import Row from './RowTypes/Row';

import ModalSelectItem from './ModalSelectItem';
import ModalEditItem from './ModalEditItem';
import MediaSelectModal from './../../Medias/MediaSelectModal';
import ContentSelectModal from './../ContentSelectModal';


class PageBuilder extends Component {

  constructor(props){
    super(props);

    this.state = {
        fields : [],
        errors : this.props.errors,

        /*
        layout : this.props.layout ? this.props.layout : [
          {
            type : 'row',
            children : [
              {
                type : 'col',
                colClass : 'col-xs-12'
              }
            ]
          }
        ],
        */

        displayItemModal : false,
        displayEditItemModal : false,
        displayMediaModal: false,
        displayContentModal: false,
        pathToIndex : null,
        editItemData : null,
        addPosition : null,
        listItemIndex : -1,
    };

    this.handleAddRow = this.handleAddRow.bind(this);
    this.handleDeleteRow = this.handleDeleteRow.bind(this);
    this.handleColTypeSelected = this.handleColTypeSelected.bind(this);
    this.handleColChanged = this.handleColChanged.bind(this);
    this.handleItemSelect = this.handleItemSelect.bind(this);
    this.handleItemCancel = this.handleItemCancel.bind(this);
    this.handleItemSelected = this.handleItemSelected.bind(this);
    this.handleContentSelect = this.handleContentSelect.bind(this);
    this.handleContentSelected = this.handleContentSelected.bind(this);
    this.handleContentCancel = this.handleContentCancel.bind(this);

  }

  componentWillReceiveProps(nextProps) {

    console.log("PageBuilder :: componentWillRecieveProps => ",nextProps);

    if(nextProps.layout != null){

      //a change has been done to layout

      if(!this.state.displayEditItemModal){
        //if the modal is not displaying, don't close the modal yet

        this.setState({
          displayItemModal : false,
          displayEditItemModal : false,
          displayContentModal : false,
          pathToIndex : null,
          addPosition : null,
          editItemData : null,
          addPosition : null
        });
      }
    }
  }

  /******** Modal Items  ********/

  handleItemSelect(pathToIndex) {

    console.log("PageBuilder :: handleItemSelect ",pathToIndex);

    this.setState({
      displayItemModal : true,
      pathToIndex : pathToIndex
    });

  }

  handleSelectItemBefore(pathToIndex) {

    console.log("PageBuilder :: handleSelectItemBefore ",pathToIndex);

    this.setState({
      displayItemModal : true,
      pathToIndex : pathToIndex,
      addPosition : "before"
    });

  }

  handleItemCancel(){
    this.setState({
      displayItemModal : false,
      pathToIndex : null,
      addPosition : null
    });
  }

  handleItemSelected(item){

    console.log("handleItemSelected => ", item);

    var layout = this.props.layout;

    if(this.state.addPosition != null && this.state.addPosition == "before"){
      //put object to the begining
      layout = this.changeRow(layout,-1,this.state.pathToIndex,item,true);
    }
    else {
      //start array with this object
      layout = this.changeRow(layout,-1,this.state.pathToIndex,item);
    }

    console.log("layout final  => ",layout);


    this.setState({
      displayItemModal : false,
      pathToIndex : null,
      addPosition : null
    });


    this.props.updateLayout(layout);

  }

  /****************/

  handleAddRow(e) {

    e.preventDefault();

    var {layout} = this.props;

    if(layout == undefined || layout == null){
      layout = [];
    }

    layout.push({
        type : 'row',
        children : [
          {
            type : 'col',
            colClass : 'col-xs-12',
            children : []
          }
        ]
      }
    );

    console.log("handleAddRow : layout : ",layout);

    /*
    this.setState({
      layout : layout
    });
    */

    this.props.updateLayout(layout);

  }

  handleColTypeSelected(index,cols){

    console.log("page builder : index : "+index+", cols : "+cols);

  }

  handleColChanged(pathToIndex,data) {

    console.log("handleColChanged => ", pathToIndex, data);

    var layout = this.props.layout;

    layout = this.changeCols(layout,-1,pathToIndex,data);

    console.log("handleColChanged : layout : ",layout);

    /*
    this.setState({
      layout : layout
    });
    */

    this.props.updateLayout(layout);
  }

  changeRow(layout,currentIndex,pathToIndex,data,before){
    currentIndex++;

    if(currentIndex == pathToIndex.length -1){

      if(layout[pathToIndex[currentIndex]].children === undefined
        || layout[pathToIndex[currentIndex]].children == null){
          layout[pathToIndex[currentIndex]].children = [];
        }

        if(before !== undefined && before){
            layout[pathToIndex[currentIndex]].children.unshift(data);
        }
        else {
            layout[pathToIndex[currentIndex]].children.push(data);
        }

        return layout;
    }
    else {

      layout[pathToIndex[currentIndex]].children = this.changeRow(
        layout[pathToIndex[currentIndex]].children,
        currentIndex,
        pathToIndex,
        data,
        before
      );

      return layout;
    }
  }

  changeCols(layout,currentIndex,pathToIndex,data){
    currentIndex++;

    if(currentIndex == pathToIndex.length -1){
      layout[pathToIndex[currentIndex]].children = data;
      return layout;
    }
    else {

      layout[pathToIndex[currentIndex]].children = this.changeCols(
        layout[pathToIndex[currentIndex]].children,
        currentIndex,
        pathToIndex,
        data
      );

      return layout;
    }
  }

  /**
  *   Method to change the value of a vield by its path to Index.
  */
  changeItem(layout,currentIndex,pathToIndex,data){
    currentIndex++;

    if(currentIndex == pathToIndex.length -1){
      layout[pathToIndex[currentIndex]].field.value = data;
      return layout;
    }
    else {

      layout[pathToIndex[currentIndex]].children = this.changeItem(
        layout[pathToIndex[currentIndex]].children,
        currentIndex,
        pathToIndex,
        data
      );

      return layout;
    }
  }

  /**
  *   Method to change the content value of the link
  */
  changeItemWithCallback(layout,currentIndex,pathToIndex,data,callback){
    currentIndex++;

    if(currentIndex == pathToIndex.length -1){

      layout[pathToIndex[currentIndex]].field = callback(
        layout[pathToIndex[currentIndex]].field,data
      );
      return layout;
    }
    else {

      layout[pathToIndex[currentIndex]].children = this.changeItemWithCallback(
        layout[pathToIndex[currentIndex]].children,
        currentIndex,
        pathToIndex,
        data,
        callback
      );

      return layout;
    }
  }

  /**
  *   Method to add a new element to a field value array. Use for images and contents.
  */
  addItem(layout,currentIndex,pathToIndex,data){
    currentIndex++;

    if(currentIndex == pathToIndex.length -1){

      if(layout[pathToIndex[currentIndex]].field.value === undefined ||
        layout[pathToIndex[currentIndex]].field.value == null){
          layout[pathToIndex[currentIndex]].field.value = [];
        }

      layout[pathToIndex[currentIndex]].field.value.push(data);
      return layout;
    }
    else {

      layout[pathToIndex[currentIndex]].children = this.addItem(
        layout[pathToIndex[currentIndex]].children,
        currentIndex,
        pathToIndex,
        data
      );

      return layout;
    }
  }

  removeItem(layout,currentIndex,pathToIndex){
    currentIndex++;

    if(currentIndex == pathToIndex.length -1){
      layout.splice([pathToIndex[currentIndex]],1);
      return layout;
    }
    else {

      layout[pathToIndex[currentIndex]].children = this.removeItem(
        layout[pathToIndex[currentIndex]].children,
        currentIndex,
        pathToIndex
      );

      return layout;
    }
  }

  changeItemChildren(layout,currentIndex,pathToIndex,callback){
    currentIndex++;

    if(currentIndex == pathToIndex.length -1){
      layout = callback(layout,pathToIndex[currentIndex]);
      return layout;
    }
    else {

      layout[pathToIndex[currentIndex]].children = this.changeItemChildren(
        layout[pathToIndex[currentIndex]].children,
        currentIndex,
        pathToIndex,
        callback
      );

      return layout;
    }
  }

  handleDeleteRow(pathToIndex) {

    console.log("handleDeleteRow => ", pathToIndex);

    var layout = this.props.layout;

    layout = this.removeItem(layout,-1,pathToIndex);

    console.log("handleDeleteRow : layout : ",layout);

    this.props.updateLayout(layout);

  }


  handleDeleteItem(item){

    var layout = this.props.layout;

    layout = this.removeItem(layout,-1,item.pathToIndex);

    this.props.updateLayout(layout);
  }

  handlePullUpItem(pathToIndex) {
    console.log("handlePullUpItem => ", pathToIndex);

    var layout = this.props.layout;

    layout = this.changeItemChildren(layout,-1,pathToIndex,function(children,index){

      if(children.length > 1 && index > 0 ){
        var temp = children[index-1];
        children[index-1] = children[index];
        children[index] = temp;
      }

      return children;
    });

    this.props.updateLayout(layout);
  }

  handlePullDownItem(pathToIndex) {
    console.log("handlePullDownItem => ", pathToIndex);

    var layout = this.props.layout;

    layout = this.changeItemChildren(layout,-1,pathToIndex,function(children,index){

      if(children.length > 1 && index < children.length-1 ){
        var temp = children[index+1];
        children[index+1] = children[index];
        children[index] = temp;
      }

      return children;
    });

    this.props.updateLayout(layout);

  }

  handleCopyItem(pathToIndex) {
    //console.log("handleCopyItem => ", pathToIndex);

    var layout = this.props.layout;

    layout = this.changeItemChildren(layout,-1,pathToIndex,function(children,index){

      var copy = jQuery.extend(true, {}, children[index]);

      if(index == children.length-1){
        //if is the last
        children.push(copy);
      }
      else {
        children.splice(index+1,0,copy);
      }

      return children;
    });

    this.props.updateLayout(layout);

  }


  handleEditItem(item){

    this.setState({
      displayEditItemModal : true,
      editItemData : item
    });

  }

  handleEditItemCancel(){

    this.setState({
      displayEditItemModal : false,
      editItemData : null
    });

  }

  renderRows() {

    const {layout} = this.props;

    return (
        layout.map((item,index) =>
          <Row
            index={index}
            key={index}
            data={item}
            childrenLength={layout.length}
            onDeleteRow={this.handleDeleteRow}
            colTypeSelect={this.handleColTypeSelected}
            onColsChanged={this.handleColChanged}
            onSelectItem={this.handleItemSelect}
            onEditItem={this.handleEditItem.bind(this)}
            onPullUpItem={this.handlePullUpItem.bind(this)}
            onPullDownItem={this.handlePullDownItem.bind(this)}
            onCopyItem={this.handleCopyItem.bind(this)}
            onDeleteItem={this.handleDeleteItem.bind(this)}
            pathToIndex={[parseInt(index)]}
            onSelectItemBefore={this.handleSelectItemBefore.bind(this)}
            onSelectItemAfter={this.handleItemSelect}
          />
        )
    );

  }

  handleOnEditField(field) {

    var data = field;

    //update data to pathToIndex
    console.log("handleOnEditField => ", this.state.editItemData.pathToIndex, data);

    var layout = this.props.layout;

    layout = this.changeItemWithCallback(layout,-1,this.state.editItemData.pathToIndex,data,
      function(field,newField){
         //field.value = newField.value;
         //field.settings = newField.settings;
         return newField;
      }
    );

    console.log("handleOnEditField : layout : ",layout);


    this.setState({
      displayEditItemModal : false,
      editItemData : null
    });

    this.props.updateLayout(layout);

  }

  handleOnAddListField(field) {

    var data = field;

    //update data to pathToIndex
    console.log("handleOnEditField => ", this.state.editItemData.pathToIndex, data);

    var layout = this.props.layout;

    layout = this.changeItemWithCallback(layout,-1,this.state.editItemData.pathToIndex,data,
      function(field,data){
         if(field.value === undefined || field.value == null){
           field.value = [];
         }
         field.value.push(data);
         return field;
      }
    );

    console.log("handleOnEditField : layout : ",layout);

    /*
    this.setState({
      displayEditItemModal : false,
      editItemData : null
    });
    */

    this.props.updateLayout(layout);

  }

  /******** Images  ********/

  handleImageSelect(field) {

    var listItemIndex = -1;
    //FIXME try to find a more elegant way
    if(field.type !== undefined && field.type == "list-item"){
      //if the event came from the list item, then save the array of the fields
      listItemIndex = field.index;
    }

    this.setState({
      displayMediaModal : true,
      listItemIndex : listItemIndex
    });

  }

  handleImageCancel(){
    this.setState({
      displayMediaModal : false,
      listItemIndex : -1
    });
  }

  handleImageSelected(media){
      this.updateImage(media);
  }

  updateImage(media){

      var layout = this.props.layout;
      var field = this.state.editItemData.data.field;
      var self = this;

      switch (field.type) {
          case FIELDS.IMAGES.type:
              layout = this.addItem(layout,-1,this.state.editItemData.pathToIndex,media);
              break;

          case FIELDS.IMAGE.type:
              layout = this.changeItem(layout,-1,this.state.editItemData.pathToIndex,media);
              break;

          case "widget":
              layout = this.changeItemWithCallback(layout,-1,this.state.editItemData.pathToIndex,media,
                  function(field,media){

                      if(field.value == null){
                        field.value = { image : null};
                      }
                      field.value.image = media;
                      return field;
                  }
              );
              break;

          case "widget-2":
              layout = this.changeItemWithCallback(layout,-1,this.state.editItemData.pathToIndex,media,
                  function(field,media){

                      var listIndex = self.state.listItemIndex;

                      if(listIndex == -1 || field.value[listIndex] === undefined ) {
                        console.error("Widget 2 edit :: listItemIndex == -1 or undefined ");
                        return field;
                      }

                      if(field.value[listIndex].value == null){
                        field.value[listIndex].value = { image : null};
                      }

                      field.value[listIndex].value.image = media;

                      return field;
                  }
              );
              break;
      }

      this.setState({
        displayMediaModal : false,
        listItemIndex : -1
      });

      this.props.updateLayout(layout);

  }

  /******** Contents  ********/

  handleContentSelect(field) {

    var listItemIndex = -1;
    //FIXME try to find a more elegant way
    if(field.type !== undefined && field.type == "list-item"){
      //if the event came from the list item, then save the array of the fields
      listItemIndex = field.index;
    }

    this.setState({
      displayContentModal : true,
      listItemIndex : listItemIndex
    });

  }

  handleContentCancel(){
    this.setState({
      displayContentModal : false,
      listItemIndex : -1
    });
  }

  handleContentSelected(content){
      this.updateContent(content);
  }

  updateContent(content){

    var self = this;
    var layout = this.props.layout;
    var field = this.state.editItemData.data.field;

    switch (field.type) {

        case FIELDS.CONTENTS.type:
            layout = this.addItem(layout,-1,this.state.editItemData.pathToIndex,content);
            break;

        case FIELDS.LINK.type:
            layout = this.changeItemWithCallback(layout,-1,this.state.editItemData.pathToIndex,content,
                function(field,data){

                    if(field.value == null){
                      field.value = {};
                    }
                    else if(field.value.url !== undefined){
                      delete field.value['url'];
                    }
                    field.value.content = content;
                    console.log("field al final => ",field);

                    return field;
                }
            );
            break;

        case "widget":
            layout = this.changeItemWithCallback(layout,-1,this.state.editItemData.pathToIndex,content,
                function(field,data){

                    console.log(field);

                    if(field.value == null){
                      field.value = { url : {}};
                    }
                    field.value.url = {
                      content : content
                    };

                    return field;
                }
            );
            break;
        case "widget-2":
            layout = this.changeItemWithCallback(layout,-1,this.state.editItemData.pathToIndex,content,
                function(field,data){

                    var listIndex = self.state.listItemIndex;

                    if(listIndex == -1 || field.value[listIndex] === undefined ) {
                      console.error("Widget 2 edit :: listItemIndex == -1 or undefined ");
                      return field;
                    }

                    if(field.value[listIndex].value == null){
                      field.value[listIndex].value = { url : {}};
                    }

                    field.value[listIndex].value.url = {
                      content : content
                    };;

                    return field;
                }
            );
            break;
    }

    this.setState({
      displayContentModal : false,
      listItemIndex : -1
    });

    this.props.updateLayout(layout);

  }


  render() {

    return (
      <div className="col-xs-9 page-content page-builder">

        <MediaSelectModal
          display={this.state.displayMediaModal}
          onImageSelected={this.handleImageSelected.bind(this)}
          onImageCancel={this.handleImageCancel.bind(this)}
          zIndex={10000}
        />

        <ContentSelectModal
          display={this.state.displayContentModal}
          onContentSelected={this.handleContentSelected}
          onContentCancel={this.handleContentCancel}
          zIndex={10000}
        />

        <ModalSelectItem
          display={this.state.displayItemModal}
          onItemSelected={this.handleItemSelected}
          onContentSelect={this.handleContentSelect}
          onItemCancel={this.handleItemCancel}
          zIndex={9000}
        />

        <ModalEditItem
          display={this.state.displayEditItemModal}
          onItemCancel={this.handleEditItemCancel.bind(this)}
          item={this.state.editItemData}
          translations={this.props.translations}
          onSubmitData={this.handleOnEditField.bind(this)}
          onImageSelect={this.handleImageSelect.bind(this)}
          onContentSelect={this.handleContentSelect.bind(this)}
          onAddField={this.handleOnAddListField.bind(this)}
          zIndex={9000}
        />

        <div className="field-group">
          <TextField
            field={this.props.title}
            translations={this.props.translations}
            onFieldChange={this.props.onFieldChange}
          />

          <SlugField
            field={this.props.slug}
            sourceField={this.props.title}
            blocked={this.props.saved}
            translations={this.props.translations}
            onFieldChange={this.props.onFieldChange}
          />

          {this.props.layout != null &&
            this.renderRows()
          }

          <FirstEmptyRow
            onAddRow={this.handleAddRow}
          />

        </div>
      </div>
    );
  }

}
export default PageBuilder;
