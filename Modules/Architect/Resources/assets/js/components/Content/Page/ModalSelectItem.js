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

  addRow(e) {

    e.preventDefault();

    this.props.onItemSelected({
      type : 'row',
      children : [
        {
          type : 'col',
          colClass : 'col-xs-12',
          children : []
        }
      ]
    });
  }

  addItem(field,e) {

    e.preventDefault();

    var newField = JSON.parse(JSON.stringify(field));

    this.props.onItemSelected({
      type : 'item',
      field : newField
    });
  }

  renderFields() {

    var fields = [];

    for( var key in FIELDS){

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