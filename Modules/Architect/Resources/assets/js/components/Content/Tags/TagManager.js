import React, {Component} from 'react';
import { render } from 'react-dom';
import Autosuggest from 'react-autosuggest';

const charMap = {
    'a': /[àáâ]/gi,
    'c': /[ç]/gi,
    'e': /[èéêë]/gi,
    'i': /[ìíï]/gi,
    'o': /[òóô]/gi,
    'oe': /[œ]/gi,
    'u': /[üú]/gi
  };

class TagManager extends Component {

  constructor(props){
    super(props);    
    this.suggestions = props.tagsList;
    
    this.state = {
        value: '',
        suggestions: this.suggestions
    };

    this.onRemoveTag = this.onRemoveTag.bind(this);
    this.handleClickOnSuggest = this.handleClickOnSuggest.bind(this);
    this.renderSuggestion = this.renderSuggestion.bind(this);
    this.handleKeyPress = this.handleKeyPress.bind(this);
  }


  loadTags() {
    //TODO hacer la petición a la api que devuelva los tags disponibles
  }

  onChange(event, { newValue })
  {
      this.setState({
          value: newValue
      });
  }

  normalize(str) {

    $.each(charMap, function (normalized, regex) {
        str = str.replace(regex, normalized);
    });
    return str.toLowerCase();
  }

  getSuggestions(value)
  {
      const inputValue = this.normalize(value.trim().toLowerCase());
      const inputLength = inputValue.length;

      var _this = this;
      return inputLength === 0 ? [] : this.suggestions.filter(function(item) {
          //return item.name.toLowerCase().slice(0, inputLength) === inputValue
          return _this.normalize(item.name.toLowerCase()).indexOf(inputValue) != -1;
      });
  }

  getSuggestionValue(suggestion)
  {
      return suggestion.name;
  }

  renderSuggestion(suggestion)
  {
      return (
          <span onClick={() => this.handleClickOnSuggest(suggestion.id)}>{suggestion.name}</span>
      );
  }

    // Autosuggest will call this function every time you need to update suggestions.
    // You already implemented this logic above, so just use it.
  onSuggestionsFetchRequested({ value })
  {
      this.setState({
          suggestions: this.getSuggestions(value)
      });
  }

    // Autosuggest will call this function every time you need to clear suggestions.
  onSuggestionsClearRequested()
  {
      this.setState({
          suggestions: []
      });
  }

  handleClickOnSuggest(id)
  {
      var self = this;

      this.suggestions.map((item, _tag) => {
          if(_tag.id === id) {
              self.props.onTagAdded(_tag);
          }
      });
  }

  handleKeyPress(event)
  {
    if(event.key == 'Enter'){
      var self = this;
      this.suggestions.map((tag, index) => {
          if(this.normalize(tag.name) == this.normalize(this.state.value)) {
              self.props.onTagAdded(tag);
          }
      });
    }
  }

  onRemoveTag(e) {
    e.preventDefault();
    this.props.onRemoveTag($(e.target).closest('.remove-btn').attr('id'))
  }

  renderTags() {
    var tagsIds = this.props.content.tags ? this.props.content.tags.map(tag => tag.id) : [];
  
    return (
      this.props.tagsList.filter(function(tag) {
        return tagsIds.indexOf(tag.id) > -1 ? tag : false;
      }).map((tag,i) => (
        <span key={i} className="tag"> {tag.name} <a href="" className="remove-btn" id={tag.id} onClick={this.onRemoveTag}> <i className="fa fa-times-circle"></i> </a> </span>
      ))
    );
  }

  render() {

    const { value, suggestions } = this.state;

    const inputProps = {
        placeholder: 'Introduex etiquetes...',
        className: 'form-control',
        value,
        onChange: this.onChange.bind(this)
    };

    return (
      <div className="tag-manager" onKeyPress={this.handleKeyPress}>
        <label htmlFor="template" className="bmd-label-floating">Etiquetes</label>

        <Autosuggest
            suggestions={suggestions}
            onSuggestionsFetchRequested={this.onSuggestionsFetchRequested.bind(this)}
            onSuggestionsClearRequested={this.onSuggestionsClearRequested.bind(this)}
            getSuggestionValue={this.getSuggestionValue}
            renderSuggestion={this.renderSuggestion}
            inputProps={inputProps}
        />

        {/* <a className="input-button"><i className="fa fa-plus"></i></a> */}

        <div className="tags">
          {this.renderTags()}
        </div>
      </div>
    );
  }

}
export default TagManager;
