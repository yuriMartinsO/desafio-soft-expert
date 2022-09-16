import React, { Component } from 'react';

class Select extends Component {
    render() {
        return (
            <select onChange={this.props.action}  name={this.props.name}>
                {this.props.options}
            </select>
        );
    }
}

export default Select;