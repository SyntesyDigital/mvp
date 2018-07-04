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
        addPosition : null
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
  changeLinkContent(layout,currentIndex,pathToIndex,data,callback){
    currentIndex++;

    if(currentIndex == pathToIndex.length -1){

      layout[pathToIndex[currentIndex]].field = callback(
        layout[pathToIndex[currentIndex]].field,data
      );
      return layout;
    }
    else {

      layout[pathToIndex[currentIndex]].children = this.changeLinkContent(
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

  removeRow(layout,currentIndex,pathToIndex){
    currentIndex++;

    if(currentIndex == pathToIndex.length -1){
      layout.splice([pathToIndex[currentIndex]],1);
      return layout;
    }
    else {

      layout[pathToIndex[currentIndex]].children = this.removeRow(
        layout[pathToIndex[currentIndex]].children,
        currentIndex,
        pathToIndex
      );

      return layout;
    }
  }

  handleDeleteRow(pathToIndex) {

    console.log("handleDeleteRow => ", pathToIndex);

    var layout = this.props.layout;

    layout = this.removeRow(layout,-1,pathToIndex);

    console.log("handleDeleteRow : layout : ",layout);

    /*
    this.setState({
      layout : layout
    });
    */

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
            onDeleteRow={this.handleDeleteRow}
            colTypeSelect={this.handleColTypeSelected}
            onColsChanged={this.handleColChanged}
            onSelectItem={this.handleItemSelect}
            onEditItem={this.handleEditItem.bind(this)}
            pathToIndex={[parseInt(index)]}
            onSelectItemBefore={this.handleSelectItemBefore.bind(this)}
            onSelectItemAfter={this.handleItemSelect}
          />
        )
    );

  }

  handleOnEditField(data) {

    //update data to pathToIndex
    console.log("handleOnEditField => ", this.state.editItemData.pathToIndex, data);

    var layout = this.props.layout;

    layout = this.changeItem(layout,-1,this.state.editItemData.pathToIndex,data);

    console.log("handleOnEditField : layout : ",layout);


    this.setState({
      displayEditItemModal : false,
      editItemData : null
    });

    this.props.updateLayout(layout);

  }

  /******** Images  ********/

  handleImageSelect(identifier) {
      console.log('handleImageSelect => ', identifier);

    this.setState({
      displayMediaModal : true
    });

  }

  handleImageCancel(){
    this.setState({
      displayMediaModal : false
    });
  }

  handleImageSelected(media){
      this.updateImage(media);
  }

  updateImage(media){

      var layout = this.props.layout;
      var field = this.state.editItemData.data.field;

      switch (field.type) {
          case FIELDS.IMAGES.type:
              layout = this.addItem(layout,-1,this.state.editItemData.pathToIndex,media);
              break;

          case FIELDS.IMAGE.type:
              layout = this.changeItem(layout,-1,this.state.editItemData.pathToIndex,media);
              break;
      }

      this.setState({
        displayMediaModal : false
      });

      this.props.updateLayout(layout);

  }

  /******** Contents  ********/

  handleContentSelect(identifier) {

    this.setState({
      displayContentModal : true
    });

  }

  handleContentCancel(){
    this.setState({
      displayContentModal : false
    });
  }

  handleContentSelected(content){
      this.updateContent(content);
  }

  updateContent(content){

    var layout = this.props.layout;
    var field = this.state.editItemData.data.field;

    switch (field.type) {
        case FIELDS.CONTENTS.type:
            layout = this.addItem(layout,-1,this.state.editItemData.pathToIndex,content);
            break;

        case FIELDS.LINK.type:
            layout = this.changeLinkContent(layout,-1,this.state.editItemData.pathToIndex,content,
                function(field,data){

                    console.log("field => ",field);
                    console.log("data => ",data);


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
    }

    this.setState({
      displayContentModal : false
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
