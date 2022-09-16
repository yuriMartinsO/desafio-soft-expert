import React, { Component } from 'react';

class InputNumber extends Component {
    render() {
        return (<input type='number' step="0.1" name={this.props.name} placeholder={this.props.placeholder} onChange={this.props.action} />);
    }
}

export default InputNumber;