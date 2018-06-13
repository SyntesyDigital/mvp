import React, {Component} from 'react';
import { render } from 'react-dom';
import PropTypes from 'prop-types'
import { findDOMNode } from 'react-dom'
import { DragSource, DropTarget } from 'react-dnd'
import FieldTypes from './FieldTypes';
import flow from 'lodash/flow';

const style = {
	cursor: 'move',
}

const fieldSource = {
	beginDrag(props) {
		return {
			id: props.id,
			index: props.index,
		}
	},
}

const fieldTarget = {
	hover(props, monitor, component) {
		const dragIndex = monitor.getItem().index
		const hoverIndex = props.index

		// Don't replace items with themselves
		if (dragIndex === hoverIndex) {
			return
		}

		// Determine rectangle on screen
		const hoverBoundingRect = findDOMNode(component).getBoundingClientRect()

		// Get vertical middle
		const hoverMiddleY = (hoverBoundingRect.bottom - hoverBoundingRect.top) / 2

		// Determine mouse position
		const clientOffset = monitor.getClientOffset()

		// Get pixels to the top
		const hoverClientY = clientOffset.y - hoverBoundingRect.top

		// Only perform the move when the mouse has crossed half of the items height
		// When dragging downwards, only move when the cursor is below 50%
		// When dragging upwards, only move when the cursor is above 50%

		// Dragging downwards
		if (dragIndex < hoverIndex && hoverClientY < hoverMiddleY) {
			return
		}

		// Dragging upwards
		if (dragIndex > hoverIndex && hoverClientY > hoverMiddleY) {
			return
		}

		// Time to actually perform the action
		props.moveField(dragIndex, hoverIndex)

		// Note: we're mutating the monitor item here!
		// Generally it's better to avoid mutations,
		// but it's good here for the sake of performance
		// to avoid expensive index searches.
		monitor.getItem().index = hoverIndex
	},
}

function collectTarget(connect, monitor) {
  return {
    connectDropTarget: connect.dropTarget(),
  };
}

function collectSource(connect, monitor) {
  return {
    connectDragSource: connect.dragSource(),
	  isDragging: monitor.isDragging(),
  };
}

class TypologyField extends Component {

	constructor(props) {
	    super(props);

		this.state = {
            name : this.props.name,
			identifier : this.props.identifier
        };

	    this.onRemoveField = this.onRemoveField.bind(this);
	    this.handleChange = this.handleChange.bind(this);
	    this.onOpenSettings = this.onOpenSettings.bind(this);
	}

	onRemoveField(event) {
	    event.preventDefault();
	    this.props.onRemoveField(this.props.id);
	}

	onOpenSettings(event) {
	    event.preventDefault();
	    this.props.onOpenSettings(this.props.id);
	}

	handleChange(event)
	{
		var name = event.target.value;
		var identifier = slugify(event.target.value, {
			replacement: '-',
			remove: /[$*+~.()'"!\-:@]/g,
			lower: true
		});

		this.setState({
			name : name,
			identifier : identifier
		});

	    var field = null;
	    if (event.target.type == "text") {
	        field = {
	            id: this.props.id,
				name : name,
				identifier : identifier
	        };
	    }

	    if (field != null) {
			this.props.onFieldChange(field);
		}

	}




  render() {

	var isEntryTitle = false;
	if(this.props.settings != null &&
		this.props.settings.entryTitle !== undefined &&
		this.props.settings.entryTitle
	){
		isEntryTitle = true;
	}

	const {
		isDragging,
		connectDragSource,
		connectDropTarget,
	} = this.props
	const opacity = isDragging ? 0 : 1

    return connectDragSource(
			connectDropTarget(

      <div className="typology-field" style={{ ...style, opacity }}>
        <div className={"field-type "+ (isEntryTitle ? "is-title" : "" ) }>
          <i className={"fa "+this.props.icon}></i> &nbsp; {this.props.label}
        </div>

        <div className="field-inputs">
          <div className="row">
            <div className="field-name col-xs-6">
              <input type="text" className="form-control" name="name" placeholder="Nom" value={this.state.name} onChange={this.handleChange}/>
            </div>
            <div className="field-id col-xs-6">
              <input type="text" className="form-control" name="identifier" placeholder="Idenfiticador" value={this.state.identifier} />
            </div>
          </div>
        </div>

        <div className="field-actions">
			<a href="" onClick={this.onOpenSettings}> Configuració</a> &nbsp;&nbsp;
			<a href="" className="remove-field-btn" onClick={this.onRemoveField}> <i className="fa fa-trash"></i> Esborrar </a>
			&nbsp;&nbsp;
        </div>
      </div>),
    );
  }

}

TypologyField.propTypes = {
	connectDragSource: PropTypes.func.isRequired,
	connectDropTarget: PropTypes.func.isRequired,
	index: PropTypes.number.isRequired,
	isDragging: PropTypes.bool.isRequired,
	id: PropTypes.any.isRequired,
	type: PropTypes.string.isRequired,
	label : PropTypes.string.isRequired,
	icon : PropTypes.string.isRequired,
	moveField: PropTypes.func.isRequired,
};

export default flow(
  DragSource(FieldTypes.SORT_FIELD, fieldSource, collectSource),
  DropTarget(FieldTypes.SORT_FIELD, fieldTarget, collectTarget)
)(TypologyField);
