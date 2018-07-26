import React, { Component } from 'react';
import ReactDOM from 'react-dom';

class Paginator extends Component {

    constructor(props)
    {
        super(props);

        this.state = {
            currPage : props.currPage,
            lastPage : props.lastPage,
            onPageChange : props.onPageChange,
        };

        console.log('props', props);
    }


    render() {
        return (
            <div>
                <ul>
                {Array.apply(null, Array(this.state.lastPage)).map(function(item, i){
                    return (
                      <li key={i}>
                          <a href="#" onClick={this.state.onPageChange(i)}>{i}</a>
                      </li>
                    );
                }, this)}
                </ul>
            </div>
        );
    }
}

export default Paginator;
