import React, {Component} from 'react';
import { render } from 'react-dom';

import PropTypes from 'prop-types';
import { DragSource } from 'react-dnd';
import FieldTypes from './FieldTypes';

const fieldSource = {
	beginDrag(props) {
		return {
			input: props.definition.input,
			name: props.definition.name,
			type: props.definition.type,
			label: props.definition.label,
			identifier: props.definition.identifier
		}
	},

	endDrag(props, monitor) {
		const item = monitor.getItem()
		const dropResult = monitor.getDropResult()

		if (dropResult) {
			console.log(`You dropped ${item.input}!`);
		}
	},
}

function collect(connect, monitor) {
	return {
		connectDragSource: connect.dragSource(),
		isDragging: monitor.isDragging()
	}
}

class ModelDragField extends Component {
	render() {
		const { isDragging, connectDragSource } = this.props
		const opacity = isDragging ? 0.4 : 1

		return connectDragSource(
			<div className="field" style={{ opacity }}>
				<i className={"fa "+ICONS[this.props.definition.input]}></i> &nbsp; {Lang.get(this.props.definition.label)}
			</div>
		)
	}
}

ModelDragField.propTypes = {
	connectDragSource: PropTypes.func.isRequired,
	isDragging: PropTypes.bool.isRequired,
	//input: PropTypes.string.isRequired,
	//label : PropTypes.string.isRequired,
	//icon : PropTypes.string.isRequired,
};

export default DragSource(FieldTypes.FIELD, fieldSource, collect)(ModelDragField);
