import React, { Component } from 'react';
import ReactDOM from 'react-dom';

class Paginator extends Component {

    constructor(props)
    {
        super(props);
        this.onPageChange.bind(this);
    }
    
    onPageChange(page, e) {
        e.preventDefault();
        this.props.onChange(page);
    }

    render() {
        
        const prevPage = this.props.currPage > 2 ? (this.props.currPage - 1) : 1;
        const nextPage = this.props.currPage < this.props.lastPage ? (this.props.currPage + 1) : this.props.lastPage;
        const currPage = this.props.currPage;
        const lastPage = this.props.lastPage;
        
        return (
            <div>
                <ul>
                <li><a href="#" onClick={(e) => this.onPageChange(prevPage, e)}>Prev</a></li>
                {Array.apply(null, Array(this.props.lastPage + 1)).map(function(item, i){
                    if(i > 0)
                        return (
                          <li key={i} className={i == currPage ? 'active' : null}>
                              <a href="#" onClick={(e) => this.onPageChange(i, e)}>{i}</a>
                          </li>
                        );
                }, this)}
                <li><a href="#" onClick={(e) => this.onPageChange(nextPage, e)}>Next</a></li>
                </ul>
            </div>
        );
    }
}

export default Paginator;
