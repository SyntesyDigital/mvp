import React, { Component } from 'react';
import ReactDOM from 'react-dom';

class MoreResults extends Component {

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

        const nextPage = this.props.currPage < this.props.lastPage ? (this.props.currPage + 1) : this.props.lastPage;
        const load_more = this.props.currPage < this.props.lastPage && null !== this.props.maxItems && this.props.maxItems > this.props.currentItems ?<li className="next"><a href="#" onClick={(e) => this.onPageChange(nextPage, e)}> LOAD MORE</a></li>:'';


        return (
                <ul className="navigation">
                    {load_more }
                </ul>
        );
    }
}

export default MoreResults;
