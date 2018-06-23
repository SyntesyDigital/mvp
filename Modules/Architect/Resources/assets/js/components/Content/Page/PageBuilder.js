import React, {Component} from 'react';
import { render } from 'react-dom';

import TextField from './../ContentFields/TextField';

import FirstEmptyRow from './RowTypes/FirstEmptyRow';
import Row from './RowTypes/Row';

import ModalSelectItem from './ModalSelectItem';
import ModalEditItem from './ModalEditItem';


class PageBuilder extends Component {

  constructor(props){
    super(props);

    this.state = {
        fields : [],
        errors : this.props.errors,

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

        displayItemModal : false,
        displayEditItemModal : false,
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

    console.log("handleColChanged => ", item);

    var layout = this.state.layout;

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
      layout : layout,
      displayItemModal : false,
      pathToIndex : null,
      addPosition : null
    });
    
    this.props.updateLayout(layout);

  }

  /****************/

  handleAddRow(e) {

    e.preventDefault();

    const {layout} = this.state;

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

    this.setState({
      layout : layout
    });

  }

  handleColTypeSelected(index,cols){

    console.log("page builder : index : "+index+", cols : "+cols);

  }

  handleColChanged(pathToIndex,data) {

    console.log("handleColChanged => ", pathToIndex, data);

    var layout = this.state.layout;

    layout = this.changeCols(layout,-1,pathToIndex,data);

    console.log("handleColChanged : layout : ",layout);

    this.setState({
      layout : layout
    });
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

    var layout = this.state.layout;

    layout = this.removeRow(layout,-1,pathToIndex);

    console.log("handleDeleteRow : layout : ",layout);

    this.setState({
      layout : layout
    });

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

    const {layout} = this.state;

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

    var layout = this.state.layout;

    layout = this.changeItem(layout,-1,this.state.editItemData.pathToIndex,data);

    console.log("handleOnEditField : layout : ",layout);

    this.setState({
      layout : layout,
      displayEditItemModal : false,
      editItemData : null
    });

  }



  render() {

    return (
      <div className="col-xs-9 page-content page-builder">

        <ModalSelectItem
          display={this.state.displayItemModal}
          onItemSelected={this.handleItemSelected}
          onItemCancel={this.handleItemCancel}
        />

        <ModalEditItem
          display={this.state.displayEditItemModal}
          onItemCancel={this.handleEditItemCancel.bind(this)}
          item={this.state.editItemData}
          translations={this.props.translations}
          onSubmitData={this.handleOnEditField.bind(this)}
        />

        <div className="field-group">
          <TextField
            field={{
              id:0,
              identifier:"title",
              values:{
                "ca" : "",
                "es" : "",
                "en" : ""
              },
              name:"Títol"
            }}
            translations={this.props.translations}
            key={1}
            onFieldChange={this.props.onFieldChange}
          />

          {this.renderRows()}

          <FirstEmptyRow
            onAddRow={this.handleAddRow}
          />

        </div>
      </div>
    );
  }

}
export default PageBuilder;
