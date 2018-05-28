import React, {Component} from 'react';
import { render } from 'react-dom';
import PropTypes from 'prop-types'
import { DropTarget } from 'react-dnd'
import update from 'immutability-helper'

import FieldTypes from './FieldTypes'
import TypologyField from './TypologyField'
import CustomFieldTypes from './../common/CustomFieldTypes'

const fieldTarget = {
	drop(props, monitor, component) {

		const item = monitor.getItem();

		component.addField(item);

		return { name: 'Dustbin' }
	},
}

function collect(connect, monitor) {
  return {
    connectDropTarget: connect.dropTarget(),
  	isOver: monitor.isOver(),
  	canDrop: monitor.canDrop()
  };
}

class TypologyDropZone extends Component {

	constructor(props){
    super(props);

		this.currentId = 1;

		this.moveField = this.moveField.bind(this);
		this.handleRemoveField = this.handleRemoveField.bind(this);
		this.handleFieldChange = this.handleFieldChange.bind(this);
		this.handleOpenSettings = this.handleOpenSettings.bind(this);
	}


	/**
	* TODO : Pensar de donde viene esta información para construir el settings.
	*/
	getSettingsStructure(type) {


		switch(type) {
			case CustomFieldTypes.TEXT :
				return {
					required : false
				};
			case CustomFieldTypes.RICH :
				return {
					required : false,
					maxCharacters : {
						checkbox : false,
						input : ""
					},
					fieldHeight : {
						checkbox : false,
						input : ""
					}
				};
			case CustomFieldTypes.CONTENTS :
				return {
					required : false,
					typesAllowed : {
						checkbox : false,
						fields : []
					}
				};
			case CustomFieldTypes.LIST :
				return {
					required : false,
					selectedList : ""
				};
			default:
				return {
					required : false
				};
		}

	}

	addField(field) {

		var field = {
			id : this.currentId,
			type : field.type,
			label : field.label,
			icon : field.icon,
			name : "",
			identifier : "",
			settings : this.getSettingsStructure(field.type)
		};

		this.currentId++;

		this.props.onFieldAdded(field);
	}

	moveField(dragIndex, hoverIndex) {
		this.props.moveField(dragIndex,hoverIndex);
	}

	handleRemoveField(fieldId) {

		this.props.onRemoveField(fieldId);

	}

	handleFieldChange(field) {
		this.props.onFieldChanged(field);

	}

	handleOpenSettings(fieldId) {
		this.props.onOpenSettings(fieldId);
	}

	renderFields() {
		const fields = this.props.fields;


		return (
			fields.map((item, i) => (
				<TypologyField
					key={item.id}
					index={i}
					id={item.id}
					type={item.type}
					label={item.label}
					icon={item.icon}
					name={item.name}
					identifier={item.identifier}
					moveField={this.moveField}
					onRemoveField={this.handleRemoveField}
					onFieldChange={this.handleFieldChange}
					onOpenSettings={this.handleOpenSettings}
				/>
			))
		);


	}

  render() {

    const { canDrop, isOver, connectDropTarget } = this.props
		const isActive = canDrop && isOver

    let className = '';
		if (isActive) {
			className += 'is-active';
		} else if (canDrop) {
			className += 'can-drop';
		}

    return connectDropTarget(
			<div className={"fields-list-container "+className}>

				{this.renderFields()}

				<div className="separator"></div>

				<div className="list-container-content-wrapper">
					<div className="list-container-content">
	          Arrosega camps en aquesta zona
	        </div>
				</div>
      </div>
		);
  }

}

TypologyDropZone.propTypes = {
  connectDropTarget: PropTypes.func.isRequired,
  isOver: PropTypes.bool.isRequired,
  canDrop: PropTypes.bool.isRequired,
};

export default DropTarget(FieldTypes.FIELD, fieldTarget, collect)(TypologyDropZone);
