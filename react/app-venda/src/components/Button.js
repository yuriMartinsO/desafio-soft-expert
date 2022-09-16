import React, { Component } from 'react';

class Button extends Component {
    render() {
        return (
            <div className='col-md-12 text-center button'>
                <button onClick={this.props.action} type="button">Salvar</button>
            </div>
        );
    }
}

export default Button;