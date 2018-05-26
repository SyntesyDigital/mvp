import React, {Component} from 'react';
import { render } from 'react-dom';

import PropTypes from 'prop-types';
import { DragSource } from 'react-dnd';
import FieldTypes from './FieldTypes';

const fieldSource = {
	beginDrag(props) {
		return {
			type: props.type,
			label: props.label,
			icon: props.icon,
		}
	},

	endDrag(props, monitor) {
		const item = monitor.getItem()
		const dropResult = monitor.getDropResult()

		if (dropResult) {
			console.log(`You dropped ${item.type}!`);
		}
	},
}

function collect(connect, monitor) {
  return {
		connectDragSource: connect.dragSource(),
		isDragging: monitor.isDragging()
  }
}

class TypologyDragField extends Component {


  render() {
		const { isDragging, connectDragSource } = this.props
		const opacity = isDragging ? 0.4 : 1

		return connectDragSource(
      <div className="field" style={{ opacity }}>
        <i className={"fa "+this.props.icon}></i> &nbsp; {this.props.label}
      </div>
    )
	}

}

TypologyDragField.propTypes = {
	connectDragSource: PropTypes.func.isRequired,
	isDragging: PropTypes.bool.isRequired,
	type: PropTypes.string.isRequired,
	label : PropTypes.string.isRequired,
	icon : PropTypes.string.isRequired,
};

export default DragSource(FieldTypes.FIELD, fieldSource, collect)(TypologyDragField);
