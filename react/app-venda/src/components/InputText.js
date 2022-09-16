import React, { Component } from 'react';

class InputText extends Component {
    render() {
        return (<input name={this.props.name} placeholder={this.props.placeholder} onChange={this.props.action} />);
    }
}

export default InputText;