import React, { Component } from 'react';
import InputText from './InputText';
import InputNumber from './InputNumber';
import Button from './Button';
import Header from './Header';

class TypeForm extends Component {
    constructor(props) {
        super(props);

        this.state = {
            typeName: '',
            taxValue: ''
        }
    }

    handleInputChange = (e) => {
        this.setState({
            [e.target.name]: e.target.value,
        });
    }

    sendRequest = () => {
        const recipeUrl = `${process.env.REACT_APP_API_ENDPOINT}/api/type`;
        const postBody = {
            name: this.state.typeName,
            tax_value: this.state.taxValue
        };

        const requestMetadata = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(postBody)
        };

        fetch(recipeUrl, requestMetadata)
            .then(res => res.json())
            .then(response => {
                if (response.error) {
                    alert(response.errorsMessages[0]);
                    return;
                }

                alert('Tipo cadastrado com sucesso!');
            });
    }

    render() {
        return (
            <div>
                <Header />
                <form className='form-page'>
                    <div className='row'>
                        <div className='col-md-12 text-center'>
                            <label>
                                Nome do tipo:
                            </label>
                            <InputText
                                name="typeName"
                                placeholder="Ex: Remédio"
                                action={this.handleInputChange}
                            />
                        </div>
                        <div className='col-md-12 text-center'>
                            <label>
                                Valor do imposto:
                            </label>
                            <InputNumber
                                name="taxValue"
                                placeholder="Ex: 150.00"
                                action={this.handleInputChange}
                            />
                        </div>
                        <Button action={this.sendRequest}/>
                    </div>
                </form>
            </div>
        );
    }
}

export default TypeForm;