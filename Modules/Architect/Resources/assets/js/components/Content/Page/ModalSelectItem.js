import React, {Component} from 'react';
import { render } from 'react-dom';

class ModalSelectItem extends Component {

  constructor(props){
    super(props);

    console.log(" ModalSelectItem :: construct ",props);

    this.onModalClose = this.onModalClose.bind(this);
    this.handleSelectItem = this.handleSelectItem.bind(this);


  }

  componentDidMount() {

    if(this.props.display){
        this.modalOpen();
    }

  }

  componentWillReceiveProps(nextProps)
  {

    if(nextProps.display){
        this.modalOpen();
    } else {
        this.modalClose();
    }
  }

  onModalClose(e){
      e.preventDefault();
      this.props.onItemCancel();
  }

  handleSelectItem(item){
    this.props.onItemSelected(item);
  }

  modalOpen()
  {
    TweenMax.to($("#select-item-modal"),0.5,{opacity:1,display:"block",ease:Power2.easeInOut});
  }

  modalClose() {

    var self =this;
      TweenMax.to($("#select-item-modal"),0.5,{display:"none",opacity:0,ease:Power2.easeInOut,onComplete:function(){
        self.setState({
          imageSelected : null
        });
      }});
  }

  exploteToObject(fields) {

    if(fields == null){
      return null;
    }

    var result = {};

    for(var i=0;i<fields.length;i++){
      result[fields[i]] = null;
    }
    return result;
  }

  addRow(e) {

    e.preventDefault();

    this.props.onItemSelected({
      type : 'row',
      settings : this.exploteToObject(ROW_SETTINGS),
      children : [
        {
          type : 'col',
          settings : this.exploteToObject(COL_SETTINGS),
          colClass : 'col-xs-12',
          children : []
        }
      ]
    });
  }

  exploteToObject(fields) {

    if(fields == null){
      return null;
    }

    var result = {};

    for(var i=0;i<fields.length;i++){
      result[fields[i]] = null;
    }
    return result;
  }

  addItem(field,e) {

    e.preventDefault();

    var newField = JSON.parse(JSON.stringify(field));

    newField.rules = this.exploteToObject(newField.rules);
    newField.settings = this.exploteToObject(newField.settings);

    this.props.onItemSelected({
      type : 'item',
      field : newField
    });
  }

  addWidget(e) {

    e.preventDefault()

    this.props.onItemSelected({
      type : 'item',
      field : {
        'class' : "",
        'rules' : null,
        "label": "WIDGET",
        "name": "Widget",
        "type": "widget",
        "icon": "fa-file-o",
        "settings": this.exploteToObject(['htmlId','htmlClass','cropsAllowed'])
      }
    });
  }

  addWidget2(e) {

    e.preventDefault()

    this.props.onItemSelected({
      type : 'item',
      field : {
        'class' : "",
        'rules' : null,
        "label": "WIDGET-2",
        "name": "Widget 2",
        "type": "widget-2",
        "icon": "fa-file",
        "settings": this.exploteToObject(['htmlId','htmlClass','cropsAllowed'])
      }
    });
  }



  renderFields() {

    var fields = [];

    var nonAllowed = [FIELDS["SLUG"].type,FIELDS["BOOLEAN"].type,FIELDS["URL"].type];

    for( var key in FIELDS){

      if(nonAllowed.indexOf(FIELDS[key].type) == -1){
        fields.push(
          <div className="col-xs-3" key={key}>
            <a href="" onClick={this.addItem.bind(this,FIELDS[key])}>
              <div className="grid-item">
                <i className={"fa "+FIELDS[key].icon}></i>
                <p className="grid-item-name">
                  {FIELDS[key].name}
                </p>
              </div>
            </a>
          </div>
        );
      }

    }

    return fields;
  }

  render() {

    return (
      <div className="custom-modal no-buttons" id="select-item-modal">
        <div className="modal-background"></div>


          <div className="modal-container">
            <div className="modal-header">
              <h2></h2>

              <div className="modal-buttons">
                <a className="btn btn-default close-button-modal" onClick={this.onModalClose}>
                  <i className="fa fa-times"></i>
                </a>
              </div>
            </div>

            <div className="modal-content">
              <div className="container">
                <div className="row">
                  <div className="col-xs-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">

                    <h3 className="card-title">Nou element</h3>
                    <h6>Selecciona de la llista el element que vols afegir: </h6>


                    <div className="grid-items">
                      <div className="row">

                        <div className="col-xs-3">
                          <a href="" onClick={this.addRow.bind(this)}>
                            <div className="grid-item">
                              <i className="fa fa-columns"></i>
                              <p className="grid-item-name">
                                Fila
                              </p>
                            </div>
                          </a>
                        </div>

                        {this.renderFields()}

                      </div>

                      <hr />

                      <div className="row">

                        <div className="col-xs-3">
                          <a href="" onClick={this.addWidget.bind(this)}>
                            <div className="grid-item">
                              <i className="fa fa-file-o"></i>
                              <p className="grid-item-name">
                                Widget Simple
                              </p>
                            </div>
                          </a>
                        </div>

                        <div className="col-xs-3">
                          <a href="" onClick={this.addWidget2.bind(this)}>
                            <div className="grid-item">
                              <i className="fa fa-file-o"></i>
                              <p className="grid-item-name">
                                Widget List
                              </p>
                            </div>
                          </a>
                        </div>

                      </div>


                    </div>

                  </div>
                </div>
              </div>

              <div className="modal-footer">
                <a href="" className="btn btn-default" onClick={this.onModalClose}> Cancel·lar </a> &nbsp;
              </div>

            </div>
        </div>
      </div>
    );
  }

}
export default ModalSelectItem;
